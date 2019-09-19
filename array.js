	var length;
	var arr=[];
  
	function loadrack() {	
		
  		$.get("api1.php", function(data){
 		var str = JSON.stringify(data);
		var array = str.split(",");
		length = array.length;
		var last=array[length-1];
		last = last.substr(1,last.length-3);
		document.getElementById("rack").innerHTML = last;
		
		var temp= array[0];
		var x=temp.length;
		
		document.getElementById("f").innerHTML = array;
		
		var res = temp.substr(2, x-3);
		var answers_array = new Array(array.length-1);
		
		var count=1;
		temp=array[0];
		x= temp.length;
		res=temp.substr(1, x-2);
		answers_array[0]=res;
		
		while(count<answers_array.length)
		{
			temp=array[count];
			x=temp.length;
			res=temp.substr(1, x-2);
			answers_array[count]=res;
			count++;
			
		}
    		arr=answers_array;
		document.getElementById("r").innerHTML = arr;
  	  });
 	}
	 window.addEventListener("load",loadrack,false);
