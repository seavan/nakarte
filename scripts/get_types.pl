#!/usr/bin/perl

require "recode.pl";
require "parser.pl";

our %resultRubrics;

sub parseAtts
{
	my ($cityName, $rubricName, $poiFile, $poiName) = @_;

	open FILE, '<', $poiFile;
	while(<FILE>)
	{
		if($_ =~ m/^\s*(.*?)\s*\:\s*(.*?)\s*$/)
		{
			$resultRubrics{$1}{$2} = '1';
		}
	}
	close FILE;
}

parseAll("parseAtts");

my $attFile = $ARGV[0];

chdir("atts");

while (($key, $value) = each(%resultRubrics)){
#    recode_print $key, "\n";
	open ATTFILE, ">", recode("$key.txt");
	while(($attr, $att_val) = each(%$value))
	{
		print ATTFILE recode($attr), "\n";
	}
	close ATTFILE;
#    recode_print "INSERT INTO attribute_types(caption, type_index) VALUES('$key', 1);\n";
}
