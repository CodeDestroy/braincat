document.addEventListener('orchid:quill', (event) => {
    console.log(event)
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link', 'image', 'video', 'formula'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
      
        ['clean']                                         // remove formatting button
    ];
    // Object for registering plugins
    event.detail.quill.register("modules/htmlEditButton", htmlEditButton);
    // Parameter object for initialization
    event.detail.options.modules = {
        toolbar: toolbarOptions,
        htmlEditButton: {
            // Flags
            debug: true,            // default:  false 
            syntax: false,             // default:  false  
            // Overlay
            okText: 'Сохранить',               // default:  "Ok"
            cancelText: 'Отмена',     
            // Labels
            // Quill Modules (for the HTML editor)

          },
    };
});