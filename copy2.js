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
          dataType: 'json'
        }).done(function(data,status){
           console.log(data+' '+status);
        }).fail(function() {
           console.log('fail');
        });

    });


  });
