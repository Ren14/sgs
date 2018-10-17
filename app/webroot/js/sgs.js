var dataTableEs = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "   Ver _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "<b>_START_ - _END_ de _TOTAL_ </b>",
    "sInfoEmpty": "<b>0 - 0 de 0</b>",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "BUSCAR: ",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "iDisplayLength": 20,
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Ultimo",
        "sNext": "Siguiente <i class='fa fa-chevron-right'></i> ",
        "sPrevious": "<i class='fa fa-chevron-left'></i> Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

function borrar(id, url){
    swal({
        title: "ATENCIÓN",
        text: "¿Está seguro de eliminar el registo?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Cancelar", "Borrar"]
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.replace(url + id);
        }
    });
}
