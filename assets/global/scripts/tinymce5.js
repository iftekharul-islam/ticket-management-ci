var useDarkMode = window.matchMedia('(prefers-color-scheme: light)').matches;

tinymce.init({
    selector: 'textarea.tinymce',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl code help',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    init_instance_callback : function(editor) {
        var freeTiny = document.querySelector('.tox .tox-notification--in');
       freeTiny.style.display = 'none';
      },
    link_list: [
      { title: 'My page 1', value: 'https://www.tiny.cloud' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
      { title: 'My page 1', value: 'https://www.tiny.cloud' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,

    /* enable title field in the Image dialog*/
      image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,

    file_picker_callback: function (callback, value, meta) {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image')
      {
      //   callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
      var input = document.createElement('input');
             input.setAttribute('type', 'file');
             input.setAttribute('accept', 'image/*');
             input.onchange = function() {
                 var file = this.files[0];
                 if(Math.round((this.files[0].size/1024)*100/100) > 2000){
                     alert('Image size maximum 200KB');
                     return false
                 }else {
                     var reader = new FileReader();
                     reader.readAsDataURL(file);
                     reader.onload = function () {
                         var id = 'blobid' + (new Date()).getTime();
                         var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                         var base64 = reader.result.split(',')[1];
                         var blobInfo = blobCache.create(id, file, base64);
                         blobCache.add(blobInfo);
                         callback(blobInfo.blobUri(), { title: file.name });
                     };
                 }
             };
             input.click();
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
      }
    },
    templates: [
      { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: '<div><table style="border-collapse: collapse; width: 100%"><thead><tr><th>Product</th><th>Cost</th><th>Really?</th></tr></thead><tbody><tr><td>TinyMCE Cloud</td><td>Get started for free</td><td>YES!</td></tr><tr><td>Plupload</td><td>Free</td><td>YES!</td></tr></tbody></table></div>' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
   });
