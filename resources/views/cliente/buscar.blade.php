<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador Autocomplete</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <style>
        #autocomplete-results {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            /* Ocultar inicialmente */
            position: absolute;
            background: white;
            z-index: 1000;
            width: 300px;
        }

        #autocomplete-results li {
            padding: 8px;
            cursor: pointer;
        }

        #autocomplete-results li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <input type="text" id="busqueda" placeholder="Buscar...">
    <ul id="autocomplete-results"></ul>

    <script>
        $(document).ready(function() {
            $('#busqueda').on('keyup', function() {
                let query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: '/buscar',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#autocomplete-results').empty().show();
                            if (data.length > 0) {
                                data.forEach(function(cliente) {
                                    $('#autocomplete-results').append(
                                        `<li>${cliente.nombre} ${cliente.segnombre || ''} ${cliente.apellidopat} ${cliente.apellidomat || ''}</li>`
                                        );
                                });
                            } else {
                                $('#autocomplete-results').append('<li>No hay resultados</li>');
                            }
                        }
                    });
                } else {
                    $('#autocomplete-results').empty().hide();
                }
            });

            // Manejar la selección de un resultado
            $(document).on('click', '#autocomplete-results li', function() {
                $('#search').val($(this).text());
                $('#autocomplete-results').empty().hide(); // Ocultar los resultados
            });
        });
    </script>
</body>

</html>
