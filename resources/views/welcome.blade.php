<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tweakers custom CSS Generator</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Styles -->

        <style>
            #main {
                margin-top: 50px;
            }

            #promo {
                text-align: center;
            }
        </style>
    </head>
    <body >
    <div id="app" class="container">
        <div id="main" class="jumbotron">
            <h1>Tweakers custom CSS generator</h1>
            <form>
                <div class="form-check">
                    <input type="checkbox" v-model="darkMode" class="form-check-input" id="input-dark-mode">
                    <label for="input-dark-mode">Nachtmodus</label>
                </div>
                <div class="ml-3">
                    <div class="form-check" v-if="darkMode">
                        <input type="checkbox" v-model="onlyNight" class="form-check-input" id="input-dark-mode">
                        <label for="input-dark-mode">Alleen als het donker is</label>
                    </div>
                    <div class="ml-3">
                        <div class="form-group" v-if="darkMode && onlyNight">
                            <label for="latitude">Breedtegraad</label>
                            <input type="number" step="any" min="-90" max="90" id="latitude" v-model="latitude">
                        </div>
                        <div class="form-group" v-if="darkMode && onlyNight">
                            <label for="longitude">Lengtegraad</label>
                            <input type="number" step="any" min="-180" max="180" id="longitude" v-model="longitude">
                        </div>
                        <div class="btn btn-primary" v-if="onlyNight" v-on:click="location">Verkrijg locatie</div>
                        <div id="error" class="alert alert-danger alert-dismissible fade show mt-4" role="alert" v-if="error">
                            @verbatim<span id="errorMessage">{{  errorMessage }}</span>@endverbatim
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="input-dark-mode"  disabled>
                    <label for="input-dark-mode">Andere forumkleuren</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="input-dark-mode"  disabled>
                    <label for="input-dark-mode">Custom Henk logo</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="input-dark-mode"  disabled>
                    <label for="input-dark-mode">Extra compact</label>
                </div>

            </form>

<br><hr><br>
            <p>Kopiëer de volgende url naar je custom CSS:</p>
            <div class="card">
                <div class="card-body"><code>@@import url("{{url('/stylesheet')}}@{{urlParameters}}");</code></div>
            </div>
        </div>


        <div class="card">
            <div id="promo" class="card-body">
                Benieuwd naar de broncode? Neem eens een kijkje op de <a href="https://github.com/custom-tweakers" target="_blank" rel="nofollow">GitHub-pagina</a>!
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
