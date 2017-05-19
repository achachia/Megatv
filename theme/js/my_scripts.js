$(document).ready(function () {
 
    $('#form_contact').on('submit', function (e) {
        var control = true,
                $this = $(this),
                data = {};
        e.preventDefault();

        /*****************************/
        $this.find('[name]').each(function (index, value) {
            var $this = $(this),
                    name = $this.attr('name'),
                    value = $this.val();

            if (value == '') {
                chaine = 'le champ  est obligatoire';
                control = false;
                $this.parent().remove("form-group");
                $this.parent().addClass("form-group has-error has-feedback");
                $this.before("<span  class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                $this.after("<span  style='color:red'>" + chaine.toUpperCase() + "</span>");

            }

            /******** controle champ e-mail *************/


        });

        if (control) {         
            /******* remplissage le tableau des valeurs *****************/
            $this.find('[name]').each(function (index, value) {
                var $this = $(this),
                        name = $this.attr('name'),
                        value = $this.val();
                data[name] = value;
            });
            /******** Envoi la requette ************/
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: data,
                dataType: 'json',
                cache: false,        
                success: function (data) {                
                    objet_message = data.message;
                    objet_message.reponse = Boolean(objet_message.reponse);
                    var balise_html = '';
                    if (objet_message.reponse) {
                        balise_html = '<p class="bg-info" style="font-size:25px"> Le message a &eacute;t&eacute; bien enregistr&eacute;. </p>';
                    }
                    else {
                        balise_html = '<p class="bg-danger" style="font-size:25px">Le formulaire est incomplet. </p>';
                    } 
                    
                    $("#message").css("display","block").html("<p style='color:red;font-size:27px'>"+balise_html+"</p>"); 
                    $('html,body').animate({scrollTop: $(".w-form").parent().offset().top}, "slow");
                     $("#message").fadeOut(8000, function () {
                                $(this).html('');
                                window.location.reload(true);
                     })
                    // window.location = 'index.html';
                },
                error: function (jqXHR, error, errorThrown) {
//                         
                }
            });

        }
        else {
            //$('html,body').animate({scrollTop: $("#erreur").offset().top}, "slow");
        }
        return false;


    });
   
});


