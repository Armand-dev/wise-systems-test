<html lang="en">
    <head>

        <title>Wise Systems Test</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body, html {
                margin: 0;
                padding: 0;
            }
        </style>

        <!-- Scripts -->
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Armand Codreanu</span>
            <div>
                <a href="https://github.com/Armand-dev/wise-systems-test">
                    <span>
                        <span class="text-black-50 mr-1" style="font-size: 14px;">
                            GitHub
                        </span>
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTIgMGMtNi42MjYgMC0xMiA1LjM3My0xMiAxMiAwIDUuMzAyIDMuNDM4IDkuOCA4LjIwNyAxMS4zODcuNTk5LjExMS43OTMtLjI2MS43OTMtLjU3N3YtMi4yMzRjLTMuMzM4LjcyNi00LjAzMy0xLjQxNi00LjAzMy0xLjQxNi0uNTQ2LTEuMzg3LTEuMzMzLTEuNzU2LTEuMzMzLTEuNzU2LTEuMDg5LS43NDUuMDgzLS43MjkuMDgzLS43MjkgMS4yMDUuMDg0IDEuODM5IDEuMjM3IDEuODM5IDEuMjM3IDEuMDcgMS44MzQgMi44MDcgMS4zMDQgMy40OTIuOTk3LjEwNy0uNzc1LjQxOC0xLjMwNS43NjItMS42MDQtMi42NjUtLjMwNS01LjQ2Ny0xLjMzNC01LjQ2Ny01LjkzMSAwLTEuMzExLjQ2OS0yLjM4MSAxLjIzNi0zLjIyMS0uMTI0LS4zMDMtLjUzNS0xLjUyNC4xMTctMy4xNzYgMCAwIDEuMDA4LS4zMjIgMy4zMDEgMS4yMy45NTctLjI2NiAxLjk4My0uMzk5IDMuMDAzLS40MDQgMS4wMi4wMDUgMi4wNDcuMTM4IDMuMDA2LjQwNCAyLjI5MS0xLjU1MiAzLjI5Ny0xLjIzIDMuMjk3LTEuMjMuNjUzIDEuNjUzLjI0MiAyLjg3NC4xMTggMy4xNzYuNzcuODQgMS4yMzUgMS45MTEgMS4yMzUgMy4yMjEgMCA0LjYwOS0yLjgwNyA1LjYyNC01LjQ3OSA1LjkyMS40My4zNzIuODIzIDEuMTAyLjgyMyAyLjIyMnYzLjI5M2MwIC4zMTkuMTkyLjY5NC44MDEuNTc2IDQuNzY1LTEuNTg5IDguMTk5LTYuMDg2IDguMTk5LTExLjM4NiAwLTYuNjI3LTUuMzczLTEyLTEyLTEyeiIvPjwvc3ZnPg==">
                    </span>
                </a>
            </div>
        </nav>

        <!-- Container -->
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 text-center">
                    <h2>
                        Valideaza CNP-ul
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CNP</label>
                            <input maxlength="13" type="text" class="form-control" id="cnp" aria-describedby="cnpHelp" placeholder="Scrie CNP-ul" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="emailHelp" class="form-text text-muted">Nu vom impartasi CNP-ul tau cu nimeni.</small>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary float-right">Valideaza</button>
                    </div>
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                <div class="col-6" id="response"></div>
            </div>
        </div>

        <script>
            $(document).ready(() => {

                $('#submit').click(() => {
                    // Get input value
                    let cnpValue = $('#cnp').val();

                    // Guard CNP length
                    if (cnpValue.length !== 13)
                    {
                        alert('CNP-ul trebuie sa contina exact 13 cifre.');
                        return;
                    }

                    // Post request to server
                    $.ajax({
                        type: 'POST',
                        url: '/validate',
                        data: {
                            cnp: cnpValue
                        },
                        success: (data) => {
                            if (data)
                            {
                                $('#response').html(
                                    '<div class="card text-white bg-success mb-3">' +
                                        '<div class="card-header">Succes</div>' +
                                        '<div class="card-body">' +
                                            '<h5 class="card-title">CNP-ul este valid!</h5>' +
                                        '</div>' +
                                    '</div>'
                                );
                            }
                            else
                            {
                                $('#response').html(
                                    '<div class="card text-white bg-danger mb-3">' +
                                        '<div class="card-header">Succes</div>' +
                                        '<div class="card-body">' +
                                            '<h5 class="card-title">CNP-ul NU este valid!</h5>' +
                                        '</div>' +
                                    '</div>'
                                );
                            }
                        },
                        error: (error) => {
                            alert('A fost o eroare la server. Incearca din nou.');
                            console.log(error);
                        }
                    });

                })
            });
        </script>
    </body>
</html>
