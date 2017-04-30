$( document ).ready(function() {

      $("button[value='modify']").click(function(event){

        var id = $(this).attr('id');
        var password = $("input."+id+"[name='password']").val();
        var name = $("input."+id+"[name='name']").val();
        var last_name = $("input."+id+"[name='last_name']").val();
        var team = $("input."+id+"[name='team']").val();
        var class_room = $("input."+id+"[name='class_room']").val();

        $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'update_db', 'id' : id, 'password' : password, 'name' : name, 'last_name' : last_name, 'team' : team, 'class_room' : class_room },
          type: 'POST',
          dataType: 'json'
        }).done(function(data,status){
           console.log(data+' '+status);
        }).fail(function() {
           console.log('fail');
        });
      });

      $("button[value='init']").click(function(event){

        var id = $(this).attr('class');
        var vps_name = $("td."+id).html();

        $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'reinit', 'vps_name' : vps_name },
          type: 'POST',
          dataType: 'json',
	        success : ajax_success,
          error : function(code,status,error){
		            console.log('code : '+code+'\n'+'status : '+status+'\n'+'error : '+error);
	        }
        });
       });
});

function ajax_success(data,status,code){

  var select = '';
  var vps_name = data['vps_name'];
  var os_info = data['os_info'];

  select += '<form name=myForm action=# method=post><p>reinit pour le vps : </p><select id=select_reinit>';

  for(i in os_info){
    // console.log('os_info[i]['id'] = '+os_info[i]['name']);
    select += '<option value='+os_info[i]['id']+'>'+os_info[i]['name']+'</option>';
  }
  // console.log(JSON.stringify(data));
  select += '</select><input type=submit value=ok></form>';

  $('#form_reinit').html(select);

  $("input[value='ok']").click(function(e){
       var template_id = $("#select_reinit").val();
       e.preventDefault();
       console.log(vps_name);
       console.log(template_id);
  $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'reinit2', 'vps_name' : vps_name ,'template_id' : template_id },
          type: 'POST',
          dataType: 'json',
          success: function(data, status, code){
             console.log('data : '+JSON.stringify(data)+'\n'+'status : '+status+'\n'+'code : '+JSON.stringify(code));
          },
          error : function(code,status,error){
                console.log('code : '+code+'\n'+'status : '+status+'\n'+'error : '+error);
          }
  });

  });
}
