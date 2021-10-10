<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../more/style.css">
    <link rel="stylesheet" href="game.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Big+Shoulders+Display:wght@100;300;400;500;600;700;800;900&family=Caveat:wght@400;500;600;700&family=Comfortaa:wght@300;400;500;600;700&family=Lobster&family=Orelega+One&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sansita+Swashed:wght@300;400;500;600;700;800;900&family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800;1,900&family=Zilla+Slab:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>Designology</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="game.js"></script>
</head>

<body>
    <?php
    $path = "../../";
    include('../../config/functions.php');
    session_start(); ?>


    <div class="content">
        <?php
        include('../../templates/left.php'); ?>

        <div class="right_content">
            <?php
            include('../../templates/nav.php');
            ?>
            <div class="game_content">
                <div class="game_title">
                    <h1 class="left_text">Ierarhia textului</h1>
                    <p class="explain">Aceasta este o pagină unde se pot exersa aspectele teoretice învățate la secțiunile ”Ierarhia Tipografică” și ”Alegerea Fonturilor”. Fiecare secvență de text de mai jos se poate edita cu click pe zona delimitată cu chenarul gri, interacționând apoi cu toolbarul de mai jos. </p>
                </div>
                <div class="game_inputs">
                    <h3 class="left_text">Editează</h3>
                    <div class="input_row" id="editText">
                        <div class="pair">
                            <label for="editarea fontului">Font</label>
                            <select name="" id="selectFont">
                                <option value="Lexend" selected>Lexend</option>
                                <option value="Playfair Display">Playfair Display</option>
                                <option value="Sansita Swashed">Sansita Swashed</option>
                                <option value="Abril Fatface">Abril Fatface</option>
                                <option value="Big Shoulders Display">Big Shoulders Display</option>
                                <option value="Caveat">Caveat</option>
                                <option value="Comfortaa">Comfortaa</option>
                                <option value="Lobster">Lobster</option>
                                <option value="Orelega One">Orelega One</option>
                                <option value="Raleway">Raleway</option>
                                <option value="Roboto">Roboto</option>
                                <option value="Sansita">Sansita</option>
                                <option value="Zilla Slab">Zilla Slab</option>
                                <!-- <option value=""></option>
                        <option value=""></option> -->


                            </select>
                        </div>
                        <div class="pair">
                            <label for="editarea dimensiunii">Dimensiune</label>
                            <input type="number" min="1" max="200" value="16" id="changeSize">
                        </div>
                        <div class="pair">
                            <label for="editarea grosimii">Greutatea</label>
                            <select name="" id="selectWeight">
                                <option value="400" selected>Regular</option>
                                <option value="200">Thin</option>
                                <option value="300">Light</option>
                                <option value="500">Medium</option>
                                <option value="600">Semi-bold</option>
                                <option value="700">Bold</option>
                                <option value="600">Black</option>
                            </select>
                        </div>
                        <div class="pair">
                            <label for="schimbarea culorii">Culoare</label>
                            <input type="color" name="" id="changeColor">
                        </div>
                    </div>
                    <div class="input_row">
                        <button id="uppercase">
                            AA
                        </button>
                        <button id="capital">
                            Aa
                        </button>
                        <button id="italic">
                            <i>I</i>
                        </button>
                        <button id="underlined">
                            U
                        </button>
                        <button id="leftalign" class="align">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10H14" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 6H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 14H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 18H14" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg>

                        </button>
                        <button id="center" class="align">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 10H16" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 6H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 14H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8 18H16" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                        <button id="rightalign" class="align">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 10H10" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18 6H6" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18 14H6" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M18 18H10" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                        <button id="justify" class="align">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 6H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 14H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M6 18H18" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="game_subject">
                    <p id="title" class="editable">Titlul exercițiului</p>
                    <p id="subtitle" class="editable">Acesta este un subtitlu</p>
                    <p id="bodycopy" class="editable">Cras finibus vehicula massa, a lacinia sem ornare quis. Cras cursus a elit vitae elementum. Fusce sed metus luctus, finibus eros sit amet, efficitur turpis. In pretium quam orci. Nulla elementum lobortis neque, eget aliquet nisl euismod sed. Ut sapien nulla, ornare quis dapibus at, maximus eget dolor. Duis mattis sapien at mi aliquam, quis euismod leo mattis. Phasellus euismod non nulla ac ultricies. Donec hendrerit erat a ipsum pulvinar, sit amet rhoncus nisl iaculis. Vivamus ut tellus vitae libero gravida varius. Nullam imperdiet sed velit vel pretium.<br><br>

                        Vestibulum rutrum lacus sem, id tempor velit pulvinar in. Nam ultrices et enim eget rhoncus. Praesent quis purus non nulla fermentum condimentum. Donec cursus iaculis tellus in iaculis. Proin auctor congue lorem, a maximus lorem gravida feugiat. Curabitur at tempor urna, ut fermentum enim. Sed sem ipsum, rhoncus eget neque nec, volutpat pulvinar velit. Donec vulputate lacinia consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum laoreet, tellus eu convallis lacinia, erat sem pellentesque enim, id lobortis arcu mauris quis mi. Aenean non sapien sapien.</p>
                    <p id="cta" class="editable">Call-to-action</p>
                    <p id="footnote" class="editable">notă de subsol - notă de subsol - notă de subsol</p>
                </div>

            </div>
            <a href="../../course.php?course=tipografie">
                <p>Înapoi</p>
            </a>

        </div>
        <?php include('../../templates/footer.php'); ?>