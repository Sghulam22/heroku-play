	var length;
	var arr=[];
	var string="";
  
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
		var answers_array = new Array(array.length-1);
		
		var count=1;
		temp=array[0];
		x= temp.length;
		var res=temp.substr(2, x-3);
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
		document.getElementById("results").innerHTML = arr;
  	  });
 	}

	function game(){
	
		var x=document.getElementById("input").value;
		var i=0;
		while(i<arr.length)
		{
		 	if(x==arr[i])
			{
				string=string+"*"+arr[i]+"*  ";
				arr[i]="erased/null";
				alert("CORRECT!!");
			}
			i++;
		 }

		document.getElementById("results").innerHTML = string;
		    	
	}
	 window.addEventListener("load",loadrack,false);
