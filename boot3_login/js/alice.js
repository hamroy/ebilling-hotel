$(document).ready(function() { //-->$().ready(function() { --> $(function() {
$('#selected-plays > li').addClass('horizontal'); //find each list item (li) that is a child (>) of an element with an ID of selected-plays (#selected-plays).
$('#selected-plays li:not(.horizontal)').addClass('sub-level'); //Does not have a class of horizontal (:not(.horizontal))
});

$(document).ready(function() {
$('a[@href^="mailto:"]').addClass('mailto'); //To get all email links
$('a[@href$=".pdf"]').addClass('pdflink'); //To get all links to PDF files
$('a[@href*="mysite.com"]').addClass('mysite'); //to get all internal links
});

$(document).ready(function() {
$('th').parent().addClass('table-heading');
$('tr:not([th]):even').addClass('even');
$('tr:not([th]):odd').addClass('odd');
$('td:contains("Henry")').next().addClass('highlight'); //highlight any table cell that referred to one of the Henry plays
$('td:contains("Henry")').siblings().addClass('highlight'); //To style the cell next to each cell containing Henry
//kode-kode di bawah ini menghasilkan output yang sama dengan kode di atas
//$('td:contains("Henry")').parent().find('td:gt(0)').addClass('highlight');
//$('td:contains("Henry")').parent().find('td').not(':contains("Henry")').addClass('highlight');
//$('td:contains("Henry")').parent().find('td:eq(1)').addClass('highlight').end().find('td:eq(2)').addClass('highlight');
});

$(document).ready(function() {
$('#switcher-normal').bind('click', function() {
$('body').removeClass('narrow');
$('body').removeClass('large');
$('#switcher .button').removeClass('selected');
$(this).addClass('selected');
});
$('#switcher-narrow').bind('click', function() {
$('body').addClass('narrow');
$('body').removeClass('large');
$('#switcher .button').removeClass('selected');
$(this).addClass('selected');
});
$('#switcher-large').bind('click', function() {
$('body').removeClass('narrow');
$('body').addClass('large');
$('#switcher .button').removeClass('selected');
$(this).addClass('selected');
});
});