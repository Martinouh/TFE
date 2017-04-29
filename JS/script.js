$( document ).ready(function() {

      $("button[value='modifier']").click(function(event){

        var id = $(this).attr('id');
        var password = $("input."+id+"[name='password']").val();
        var prenom = $("input."+id+"[name='prenom']").val();
        var nom = $("input."+id+"[name='nom']").val();
        var classe = $("input."+id+"[name='classe']").val();

        $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'update_db', 'id' : id, 'password' : password, 'prenom' : prenom, 'nom' : nom, 'classe' : classe },
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
        var nom_vps = $("td."+id).html();

        $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'reinit', 'nom_vps' : nom_vps },
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
  var nom_vps = data['nom_vps'];
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
       var option_value = $("#select_reinit").val();
       e.preventDefault();
       console.log(nom_vps);
       console.log(option_value);
       debugger
  $.ajax({
          url: './appel_functions.php',
          data: { 'function' : 'reinit2', 'nom_vps' : nom_vps ,'option_value' : option_value },
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
