#!/usr/bin/perl

use Encode;

#system("\@chcp 1251");

sub recode
{
	return encode("cp1251", decode("utf-8", $_[0]));
}

sub unrecode
{
	$char = $_[0];
	$char = decode("cp-1251", $char);
	return $char;
}


sub recode_print
{
	print recode($_) foreach(@_);
}

return true;
