$(document).ready(function () {

    /*mostrar servicios dependiendo del tipo de servicio seleccionado*/



    $(document).ready(function () {
        $('#grupo_asignado').on('change', function () {
            var asignacionGrupoId = $(this).val();

            // Realizar la solicitud Ajax
            $.ajax({
                url: '/obtener-datos-asignacion-grupo',
                type: 'GET',
                data: {
                    grupo_asignado: asignacionGrupoId
                },
                success: function (response) {
                    // Rellenar los otros campos del formulario con los datos recibidos
                    $('#persona').val(response.persona);
                    $('#asignatura').val(response.asignatura);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });


    $(document).ready(function () {
        $('#horario').on('change', function () {
            var horarioId = $(this).val();

            // Realizar la solicitud Ajax
            $.ajax({
                url: '/obtener-datos-horario',
                type: 'GET',
                data: {
                    horario: horarioId
                },
                success: function (response) {
                    // Rellenar los otros campos del formulario con los datos recibidos
                    $('#jornada').val(response.jornada);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    $(document).ready(function () {
        $('#aula').on('change', function () {
            var aulaId = $(this).val();

            // Realizar la solicitud Ajax
            $.ajax({
                url: '/obtener-datos-aula',
                type: 'GET',
                data: {
                    aula: aulaId
                },
                success: function (response) {
                    // Rellenar los otros campos del formulario con los datos recibidos
                    $('#sede').val(response.sede);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
});
