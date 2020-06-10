function gotopg(pg)
{
	window.location.href=pg;
}
function getSelected(opt,ret) {
	var selected = new Array();
	var index = 0;
	var index2 = 0;
	for (var intLoop = 0; intLoop < opt.length; intLoop++) {
	   if ((opt[intLoop].selected) || (opt[intLoop].checked)) {
		  index = selected.length;
		  selected[index] = new Object;
		  selected[index].value = opt[intLoop].value;
		  selected[index].index = intLoop;
		  index2++;
	   }
	}
	if(ret==0)
	{
		return selected;
	}
	else
	{
		return index2;
	}
 }

 function outputSelected(opt,rtype) {
	var sel = getSelected(opt,rtype);
	var strSel = "";
	for (var item in sel)       
	   strSel += sel[item].value + ",";
	return strSel;
 }