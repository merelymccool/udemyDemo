$(document).ready(function() { 

// Initialize CKEditor
ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );


// Select all posts

$('#selectAllCheckbox').click(function(event){
    if(this.checked) {
        $('.checkBoxes').each(function(){
            this.checked = true;
        });
    } else {
        $('.checkBoxes').each(function(){
            this.checked = false;
        });

    }
});


    
});