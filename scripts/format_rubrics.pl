#!/usr/bin/perl

require "recode.pl";
require "parser.pl";



sub parseInsertObject
{
	my ($cityName, $rubricName, $poiFile, $poiName) = @_;
	my $atts;

	open FILE, '<', $poiFile;
	while(<FILE>)
	{
		if($_ =~ m/^\s*(.*?)\s*\:\s*(.*?)\s*$/)
		{
			$atts{recode($1)} = recode($2);
		}
	}
	close FILE;
	$address = $atts{'Адрес'};
#	binmode STDOUT, ":utf8";
	$poiName =~ s/\'/\\\'/;

	print "SET \@rubric_id = (SELECT MAX(id) FROM rubrics WHERE LOWER(name) LIKE LOWER('\%$rubricName\%'));\n";
	print "SET \@city_id = (SELECT id FROM cities WHERE name LIKE '\%$cityName\%');\n";
	print "SET \@poi_id = (SELECT min(id) FROM pois WHERE address = '$address' AND caption = '$poiName');\n";
	print "UPDATE pois SET city_id = \@city_id WHERE id = \@poi_id;\n";
	print "INSERT INTO pois_rubrics(poi_id, rubric_id) VALUES(\@poi_id, \@rubric_id);\n";
}

print "SET NAMES 'cp1251';\n";
print "DELETE FROM pois_rubrics;\n";
parseAll("parseInsertObject");
print "DELETE FROM pois_rubrics WHERE poi_id IS NULL;\n";

