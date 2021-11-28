function blinking_header()
{
if (!document.getElementById('blink').style.color)
	{
	document.getElementById('blink').style.color="red";
	}
if (document.getElementById('blink').style.color=="red")
	{
	document.getElementById('blink').style.color="black";
	}
else
	{
	document.getElementById('blink').style.color="red";
	}
timer=setTimeout("blinking_header()",100);
}

function stoptimer()
{
clearTimeout(timer);
}