var deleteForm = '';
$( document ).ready(function() {
    // fix bootstrap отображения имени файла в у стилизованного поля загрузки файла
    $('.custom-file-input').on('change',function(evt){
        // var fileName = $(this).val();
        if(evt.target.files.length) {
            let fileName = evt.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        }
    });

    // радиоселектор выбранного поля
    // input text для указания имени файла
    // input file для загрузки файла
    $('#radio-text').on('click',function(){
        $('#input-image').prop( "disabled", false ).focus();
        $('#input-file').prop( "disabled", true );
        $('img.img-thumbnail').addClass('current-img');
    });
    $('#input-image').focusout(function(){
        $('img.img-thumbnail').removeClass('current-img');
    });
    $('#radio-file').on('click',function(){
        $('#input-file').prop( "disabled", false ).focus();
        $('#input-image').prop( "disabled", true );
    });

    // модальное окно подтверждения удаления элемента
    $('#deleteModal').on('show.bs.modal', function (evt) {
        deleteForm = $(evt.relatedTarget.parentElement);
        //link = event.relatedTarget.href;
        let button = $(evt.relatedTarget); // Button that triggered the modal
        let id = button.data('id'); // Extract info from data-* attributes
        let name = button.data('name'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $(this).find('.modal-title span').text(id);
        $(this).find('.modal-body p span').text(name);
        $(this).trigger('focus');
    });

    // оправка формы для удаления элемента при подтверждении в модальном окне
    $('#modalSubmit').on('click', function () {
        deleteForm.submit();
    });

    // подключение визуального редактора на страницах редактирования/добавления для textarea c id=editor
    let editor = document.querySelector('#editor');
    if (editor && typeof CKEDITOR !== "undefined") {
        CKEDITOR.replace( 'editor', {
            customConfig: '/assets/js/ckeditor_config.js'
        } );
    }
});
