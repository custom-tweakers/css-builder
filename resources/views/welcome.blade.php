<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tweakers custum CSS Generator</title>
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


            <form v-on:submit="generate">
                <div class="form-check">
                    <input type="checkbox" v-model="onlyDarkMode" class="form-check-input" id="input-dark-mode">
                    <label for="input-dark-mode">Nachtmodus</label>
                </div>
                <div class="form-check" v-if="onlyDarkMode">
                    <input type="checkbox" v-model="locationBased" class="form-check-input" id="input-dark-mode" disabled>
                    <label for="input-dark-mode">Alleen als het donker is</label>
                </div>
                <div class="form-group" v-if="onlyDarkMode && locationBased">
                    <label for="latitude">Breedtegraad</label>
                    <input type="text" id="latitude"  disabled>
                </div>
                <div class="form-group" v-if="onlyDarkMode && locationBased">
                    <label for="longitude">Lengtegraad</label>
                    <input type="text" id="longitude"  disabled>
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


                <input type="submit" class="btn btn-primary" value="Genereer CSS"></input>
            </form>
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
