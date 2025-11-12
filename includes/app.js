$(document).ready(function() {
  
    function executarBuscaAjax(termo) {
        
      
        if (termo.length < 1 && termo.length > 0) {
           
             $('#lista-perfumes-ajax').html('<p style="color: white; text-align: center; width: 100%;">Digite mais para pesquisar...</p>');
             return; 
        }

       
        if (termo === '') {
        
            location.href = 'todosPerfumes.php'; 
            return;
        }


        $.ajax({
            url: 'busca.php', 
            method: 'POST',    
            data: { busca: termo }, 
            dataType: 'html',  
            
            beforeSend: function() {
                $('#lista-perfumes-ajax').html('<p style="color: white; text-align: center; width: 100%;">Carregando...</p>');
            },
            
            success: function(response) {
              
                $('#lista-perfumes-ajax').html(response);
            },
            
            error: function(jqXHR, textStatus, errorThrown) {
             
                console.error("Erro AJAX: " + textStatus, errorThrown);
                $('#lista-perfumes-ajax').html('<p style="color: red; text-align: center; width: 100%;">Erro ao carregar os resultados da busca.</p>');
            }
        });
    }


    $('#campo-busca').on('keyup', function() {
        var termo = $(this).val();
        executarBuscaAjax(termo);
    });

    $('#form-busca').on('submit', function(e) {
        e.preventDefault();
        var termo = $('#campo-busca').val();
        executarBuscaAjax(termo);
    });
    
 
    var termoInicial = $('#campo-busca').val();
    if (termoInicial !== '') {
        executarBuscaAjax(termoInicial);
    }
});
