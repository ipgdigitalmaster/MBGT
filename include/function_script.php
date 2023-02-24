<script language="JavaScript">
function Confirm(url){
		if(confirm("Are you sure?")){
				window.location.href= url;
		}
}
function chkAll(frm, arr, mark) {
  for (i = 0; i <= frm.elements.length; i++) {
   try{
     if(frm.elements[i].name == arr) {
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}
 

	
function check_text(iform,mess,el_name)
                {
                        var message=mess+" Form \nThe following field(s) needs to be completed or redone before : \n";
                        var objForm = eval(iform);
                        var len = eval(objForm.length);
                         var sum=el_name.split(",");
                        var check=0;

                        var y=0;
                                         for(var i=0;i<len;i++){
                                                                if(objForm.elements[i].name==sum[y]){
                                                                                if (objForm.elements[i].value=='')
                                                                                        {
                                                                                                        message=message+"   * "+sum[y].toUpperCase()+" \n";
                                                                                                                 y++;
                                                                                                check=1;
                                                                                        }
                                                                                else
                                                                                        {
                                                                                                y++;
                                                                                        }
                                                                }
                                                }
                        if (check==1)
                                {
                                        alert(message);
                                        return false;
                                }
                        else
                                {
                                        return true;
                                }

                }
</script>	