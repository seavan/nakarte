#!/usr/local/bin/perl


use LWP::Simple;
use Encode;
use HTTP::Request;
use utf8;

require('recode.pl');

my $url = $ARGV[0];

sub formatRequest {

my $request = HTTP::Request->new(GET => $_[0]); $request->header('accept', 
'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'); 
$request->header('User-Agent',	'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; 
rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7 (.NET CLR 3.5.30729)'); 
$request->header('Accept', 
'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'); 
$request->header('Accept-Language',	'ru,en-us;q=0.7,en;q=0.3'); 
$request->header('Accept-Encoding',	'*'); $request->header('Accept-Charset',	
'windows-1251,utf-8;q=0.7,*;q=0.7'); $request->header('Keep-Alive',	'300'); 
$request->header('Connection',	'keep-alive'); $request->header('Cookie',	
'sd_stat=1333290142%7C1269280800; hotlog=1; astratop=1'); 

return $request;
}

sub escape
{
	my $input = $_[0];
	$input =~ s/'/\\'/g;
	$input =~ s/&nbsp;/ /g;
	$input =~ s/\n/ /g;
	$input =~ s/\r/ /g;
	$input =~ s/^\s+//g;
	$input =~ s/\s+$//g;
	return $input;
}

sub readPoi
{
	my $url = $_[0];
	my $fname = encode( "cp1251", decode("utf-8", $_[1])) . ".txt";

	if(-e $fname)
	{
		return;
	}

	my $ua = LWP::UserAgent->new;
 
	my $response = $ua->request(formatRequest($url));

	my $content = $response->content();

	if($content =~ m/\<td class="ct15"\>(.*?)\<\/td\>/)
	{
		print "$1\n";
	}

	
	open FILE, ">", $fname or die $!;

	while($content =~ m/\<b\>(.*?)\<\/b\>(.*?)\</g)
	{
			my $caption = $1;
			my $res = $2;
#			print "cpt $caption\";
			$res =~ s/\:\&nbsp\;//;
			print FILE "$caption: $res\n";
	}
	close(FILE);
}

sub readChapterLinks
{
	my $fname= $_[0];
	my $ua = LWP::UserAgent->new;
	my $content = '';

	open FILE, '<', $fname;
	
	$content .= $_ while(<FILE>);

	print "SET NAMES 'cp1251';\n";
	print "DELETE FROM import1s;\n";

	while($content =~ m~\<a.*?href=\"(/almaty/goods.php.*?)\".*?\>\s*(.*?)\s*\[(\d+)\]\<\/a\>~g)
	{
		$link = 'http://nash-gorod.kz' . $1;
		$caption = escape($2);
		$count = $3;
		print "INSERT INTO import1s(link, icount, caption) VALUES('$link', $count, '$caption');\n";
		readChapter($1);
	}
}

sub readChapter
{
	my $url = $_[0];
	open FILE, ">>", $_[1];
	my $ua = LWP::UserAgent->new;
	my $found;
	$index = 1;

	do {
		$found = 0;
		$mu = $url . "&pg=" . $index;
#		print $mu, "\n";
		my $response = $ua->request(formatRequest($mu));
		my $content = $response->content();

		while($content =~ m/\<\s*strong\s*\>(.*?)\<\/\s*strong\s*\>.*?/ig)
		{
#			print $1 , "\n";
			
			$title = $1;

			if($content =~ m~nash_09.*?>(.*?)\<BR\>~sig)
			{
				$addr = $1;
#				print $1 , "\n";
			}

			if($content =~ m~nash_15.*?>(.*?)\<BR\>~sig)
			{
				$phone = $1;
#				print $1 , "\n";
			}
			if($content =~ m~nash_20.*?>(.*?)\<(BR|\/DIV)\>~ig)
			{
				$contacts = $1;
#				print $1 , "\n";
			}

			if($content =~ m~style=\"display:none\"\>(.*?)\<\/DIV\>~ig)
			{
				$add = $1;
#				print $1 , "\n";
			}

			if( length($addr) )
			{
				$title = escape($title);
				$addr = escape($addr);
				$phone = escape($phone);
				$add = escape($add);
				print FILE "INSERT INTO import1pois(url, title, address, phone, info) VALUES('$url', '$title', '$addr', '$phone', '$add');\n";
			}
			++$found;
		}
		++$index;

	} 
	until ($found == 0);
	
	close(FILE);
}

sub readCities
{
	my $url = $_[0];
	my $ua = LWP::UserAgent->new;

	my $response = $ua->request(formatRequest($url));
	my $content = $response->content();


	while($content =~ m/\<a.*?href=\"(.*?)\".*?class=\"ln16\".*?\>\s*(.*?)\s*\<\/a\>/g)
	{
			my $url = "http://realkz.com/" . $1;
			print "BEGIN CITY $url $2\n";
			my $dirname = encode( "cp1251", decode("utf-8", $2));
			if( -d $dirname )
			{
				print "SKIP CITY\n";
				next;
			}
			
			print "CREATE $dirname\n";
			mkdir $dirname or die $!;
			chdir $dirname;

			eval
			{
				readDeps($url, $2);
			};

			chdir ("..");
	}
}

sub readDeps
{
	my $url = $_[0];

	my $ua = LWP::UserAgent->new;

	my $response = $ua->request(formatRequest($url));
	my $content = $response->content();

	while($content =~ m/\<a.*?href=\"(\S*?type_id=(?:138|139|140|325|1238)\S*?)\".*?class=\"ln4\".*?\>(.*?)\s+.*?\<\/a\>/g)
	{
			my $url = "http://realkz.com/" . $1;
			my $dirname = encode( "cp1251", decode("utf-8", $2));
			print "BEGIN DEP $url $dirname\n";


			if( -d $dirname )
			{
				print "SKIP DEP\n";
				next;
			}

			print "CREATE $dirname\n";
			mkdir $dirname;
			chdir $dirname;
			eval
			{

				readChapterLinks($url, $dirname);
			};
			chdir("..");

	}
}


#readPoi($url);

#readChapterLinks($ARGV[0]);

readChapter($ARGV[0], "import1poi.sql");

#readCities($url);

#print $response->content();
