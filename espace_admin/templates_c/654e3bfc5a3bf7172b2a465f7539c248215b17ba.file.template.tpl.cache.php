<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-17 11:46:16
         compiled from "C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\Mega-cous-ligne\debug_test\espaceprof\vues\template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:720455ce6cabc21f33-66701029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '654e3bfc5a3bf7172b2a465f7539c248215b17ba' => 
    array (
      0 => 'C:\\Program Files (x86)\\EasyPHP-DevServer-14.1VC11\\data\\localweb\\Mega-cous-ligne\\debug_test\\espaceprof\\vues\\template.tpl',
      1 => 1439804771,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '720455ce6cabc21f33-66701029',
  'function' => 
  array (
  ),
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55ce6cabce0a20_47015337',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ce6cabce0a20_47015337')) {function content_55ce6cabce0a20_47015337($_smarty_tpl) {?><!DOCTYPE html>
<html lang="fr">
    <head>
       <?php echo $_smarty_tpl->getSubTemplate ("vues/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    </head>    
    <body> 
        <p>&nbsp;</p>
        <div id="page" class="container">

            <header id="header" class="row"  style="height: 200px;background: url(./../media/images/image_header_prof.jpg)">
                <div class="col-md-4">                
                    <img src="./../media/images/favicon.png" alt="" style="width:120px;height: 120px "  />
                </div>


            </header>

            <!-- inclusion le fichier nav -->
            <nav id="menu" class="navbar navbar-default" role="navigation">
                <?php echo $_smarty_tpl->getSubTemplate ("vues/nav_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

            </nav>    
            <ul class="breadcrumb">
                <?php echo $_smarty_tpl->getSubTemplate ("vues/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

            </ul>
           <div id="Basic">
                 The fileinput-button span is used to style the file input field as button 
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                     The file input field used as target for the file upload widget 
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
                <br>
                <br>
                 The global progress bar 
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>                 
                <div id="files" class="files"></div>
               <!-- -------- script ---------------- -->
                <?php echo '<script'; ?>
>
                    /*jslint unparam: true */
                    /*global window, $ */
                    $(function () {
                        'use strict';
                        // Change this to the location of your server-side upload handler:
                        var url = 'upload_files/';
                        /* url = window.location.hostname === 'blueimp.github.io' ?
                         '//jquery-file-upload.appspot.com/' : 'server/php/'; */

                        $('#fileupload').fileupload({
                            url: url,
                            dataType: 'json',
                            done: function (e, data) {
                                $.each(data.result.files, function (index, file) {
                                    $('<p/>').text(file.name).appendTo('#files');
                                });
                            },
                            progressall: function (e, data) {
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                $('#progress .progress-bar').css(
                                        'width',
                                        progress + '%'
                                        );
                            }
                        }).prop('disabled', !$.support.fileInput)
                                .parent().addClass($.support.fileInput ? undefined : 'disabled');
                    });
                <?php echo '</script'; ?>
>
            </div>
<!--          <div id='basic_plus'>
                 The fileinput-button span is used to style the file input field as button 
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                     The file input field used as target for the file upload widget 
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
                <br>
                <br>
                 The global progress bar 
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                 The container for the uploaded files 
                <div id="files" class="files"></div>
              
                 The jQuery UI widget factory, can be omitted if jQuery UI is already included 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"><?php echo '</script'; ?>
>
                 The Load Image plugin is included for the preview images and image resizing functionality 
                <?php echo '<script'; ?>
 src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"><?php echo '</script'; ?>
>
                 The Canvas to Blob plugin is included for image resizing functionality 
                <?php echo '<script'; ?>
 src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"><?php echo '</script'; ?>
>
                
                 The File Upload processing plugin 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload-process.js"><?php echo '</script'; ?>
>
                 The File Upload image preview & resize plugin 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload-image.js"><?php echo '</script'; ?>
>
                 The File Upload audio preview plugin 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload-audio.js"><?php echo '</script'; ?>
>
                 The File Upload video preview plugin 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload-video.js"><?php echo '</script'; ?>
>
                 The File Upload validation plugin 
                <?php echo '<script'; ?>
 src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload-validate.js"><?php echo '</script'; ?>
>
                <?php echo '<script'; ?>
>
                                    /*jslint unparam: true, regexp: true */
                                    /*global window, $ */
                                    $(function () {
                                        'use strict';
                                        // Change this to the location of your server-side upload handler:
                                        var url = window.location.hostname === 'blueimp.github.io' ?
                                                '//jquery-file-upload.appspot.com/' : 'upload_files/',
                                                uploadButton = $('<button/>')
                                                .addClass('btn btn-primary')
                                                .prop('disabled', true)
                                                .text('Processing...')
                                                .on('click', function () {
                                                    var $this = $(this),
                                                            data = $this.data();
                                                    $this
                                                            .off('click')
                                                            .text('Abort')
                                                            .on('click', function () {
                                                                $this.remove();
                                                                data.abort();
                                                            });
                                                    data.submit().always(function () {
                                                        $this.remove();
                                                    });
                                                });
                                        $('#fileupload').fileupload({
                                            url: url,
                                            dataType: 'json',
                                            autoUpload: false,
                                            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
                                            maxFileSize: 999000,
                                            // Enable image resizing, except for Android and Opera,
                                            // which actually support image resizing, but fail to
                                            // send Blob objects via XHR requests:
                                            disableImageResize: /Android(?!.*Chrome)|Opera/
                                                    .test(window.navigator.userAgent),
                                            previewMaxWidth: 100,
                                            previewMaxHeight: 100,
                                            previewCrop: true
                                        }).on('fileuploadadd', function (e, data) {
                                            data.context = $('<div/>').appendTo('#files');
                                            $.each(data.files, function (index, file) {
                                                var node = $('<p/>')
                                                        .append($('<span/>').text(file.name));
                                                if (!index) {
                                                    node
                                                            .append('<br>')
                                                            .append(uploadButton.clone(true).data(data));
                                                }
                                                node.appendTo(data.context);
                                            });
                                        }).on('fileuploadprocessalways', function (e, data) {
                                            var index = data.index,
                                                    file = data.files[index],
                                                    node = $(data.context.children()[index]);
                                            if (file.preview) {
                                                node
                                                        .prepend('<br>')
                                                        .prepend(file.preview);
                                            }
                                            if (file.error) {
                                                node
                                                        .append('<br>')
                                                        .append($('<span class="text-danger"/>').text(file.error));
                                            }
                                            if (index + 1 === data.files.length) {
                                                data.context.find('button')
                                                        .text('Upload')
                                                        .prop('disabled', !!data.files.error);
                                            }
                                        }).on('fileuploadprogressall', function (e, data) {
                                            var progress = parseInt(data.loaded / data.total * 100, 10);
                                            $('#progress .progress-bar').css(
                                                    'width',
                                                    progress + '%'
                                                    );
                                        }).on('fileuploaddone', function (e, data) {
                                            $.each(data.result.files, function (index, file) {
                                                if (file.url) {
                                                    var link = $('<a>')
                                                            .attr('target', '_blank')
                                                            .prop('href', file.url);
                                                    $(data.context.children()[index])
                                                            .wrap(link);
                                                } else if (file.error) {
                                                    var error = $('<span class="text-danger"/>').text(file.error);
                                                    $(data.context.children()[index])
                                                            .append('<br>')
                                                            .append(error);
                                                }
                                            });
                                        }).on('fileuploadfail', function (e, data) {
                                            $.each(data.files, function (index) {
                                                var error = $('<span class="text-danger"/>').text('File upload failed.');
                                                $(data.context.children()[index])
                                                        .append('<br>')
                                                        .append(error);
                                            });
                                        }).prop('disabled', !$.support.fileInput)
                                                .parent().addClass($.support.fileInput ? undefined : 'disabled');
                                    });
                <?php echo '</script'; ?>
>
            </div>  -->
            <div id="contenu">
            
                
            </div>

            <div class="clearfix">&nbsp;</div>
            <footer id="footer" class="row">
               <?php echo $_smarty_tpl->getSubTemplate ("vues/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

            </footer>
        </div>  
        <p>&nbsp;</p>
        <?php echo '<script'; ?>
 type="text/javascript">
//            var auto_refresh = setInterval(
//                    function () {
//                        $('#nbre_messages').load('./vues/membre/record_count_message.php').fadeIn("slow");
//                    }, 1000000);

        <?php echo '</script'; ?>
>
    </body>
</html>

<?php }} ?>
