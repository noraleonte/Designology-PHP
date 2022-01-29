<?php include('./templates/header.php'); ?>

<link rel="stylesheet" href="./more/form.css">
<script src="./js/form.js"></script>

</head>

<body>
    <?php
    session_start();
    include('./config/functions.php');
    if (!isset($_SESSION['name'])) {
        header('Location: login.php');
    } else {
        $user = new Users();
        if ($user->isAdmin($_SESSION['user_id'])) {


            if (isset($_SESSION['ok'])) {
                $ok = $_SESSION['ok'];
            } else {
                $ok = 0;
            }
            if (isset($_SESSION['courseTitle'])) {
                $courseTitle = $_SESSION['courseTitle'];
            } else {
                $courseTitle = '';
            }

            if (isset($_SESSION['intro'])) {
                $intro = $_SESSION['intro'];
            } else {
                $intro = '';
            }
            if (isset($_SESSION['title'])) {
                $title = $_SESSION['title'];
            } else {
                $title = '';
            }
            if (isset($_SESSION['chapter_type'])) {
                $chapter_type = $_SESSION['chapter_type'];
            } else {
                $chapter_type = 0;
                $_SESSION['ok'] = 0;
                $ok = 0;
            }
            if (isset($_SESSION['chapterpoints'])) {
                $chapterpoints = $_SESSION['chapterpoints'];
            } else {
                $chapterpoints = 0;
            }
            if (isset($_SESSION['game_url'])) {
                $game_url = $_SESSION['game_url'];
            } else {
                $game_url = '';
            }


            if (isset($_SESSION['chapters'])) {
                $chapters = $_SESSION['chapters'];
            } else {
                $chapters = array();
            }
            if (isset($_SESSION['chapter'])) {
                $chapter = $_SESSION['chapter'];
            } else {
                $chapter = ['title' => '', 'points' => 0, 'type' => 0, 'subsections' => array()];
            }

            if (isset($_SESSION['subsection'])) {
                $subsection = $_SESSION['subsection'];
            } else {
                $subsection = ['type' => 0, 'image' => '', 'text' => ''];
            }
            if (isset($_SESSION['color'])) {
                $color = $_SESSION['color'];
            } else {
                $color = '';
            }
            if (isset($_SESSION['highlight'])) {
                $highlight = $_SESSION['highlight'];
            } else {
                $highlight = '';
            }
            if (isset($_SESSION['subtitle'])) {
                $subtitle = $_SESSION['subtitle'];
            } else {
                $subtitle = '';
            }
            $errors = ['course' => '', 'top_landsc' => '', 'left_landsc' => '', 'right_landsc' => '', 'chapter' => '', 'right_portrait' => '', 'left_portrait' => '', 'square1' => '', 'square2' => '', 'square3' => '', 'plain_txt' => '', 'subsection' => '', 'courseTitle' => '', 'chapterTitle' => '', 'highlight' => '', 'subtitle' => ''];

            if (isset($_POST['cover_submit'])) {
                if (!empty($_POST['courseTitle'])) {
                    $_SESSION['courseTitle'] = $_POST['courseTitle'];
                }
                if (!empty($_POST['intro'])) {
                    $_SESSION['intro'] = $_POST['intro'];
                }
                if (!empty($_POST['color'])) {
                    $_SESSION['color'] = $_POST['color'];
                }
                if ($_FILES['cover']) {

                    $file = $_FILES['cover'];
                    $fileName = $_FILES['cover']['name'];
                    $fileType = $_FILES['cover']['type'];
                    $fileNameTmp = $_FILES['cover']['tmp_name'];
                    $fileError = $_FILES['cover']['error'];
                    $fileSize = $_FILES['cover']['size'];

                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileError === 0) {
                            if ($fileSize < 500000000) {
                                $_SESSION['cover_name'] = $fileName;
                                $fileDest = "./img/" . $fileName;
                                $_SESSION['cover_dest'] = $fileDest;
                                move_uploaded_file($fileNameTmp, $fileDest);
                            } else {
                                $errors['course'] = "Fisierul este prea mare!";
                            }
                        } else {
                            $errors['course'] = "Am întâmpinat o eroare!";
                        }
                    } else {
                        $errors['course'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['course'] = "Trebuie să ai și o imagine!";
                }
            }



            if (isset($_POST['start_chapter'])) {
                if (empty($_POST['chapterTitle'])) {
                    $errors['chapterTitle'] = "Trebuie sa ai un titlu!";
                } else {
                    if (!preg_match('/^([a-zA-Z?!.]+\s)*[a-zA-Z?!.]+$/', $_POST['chapterTitle'])) {
                        $errors['chapterTitle'] = "Titlul poate să conțină doar litere și spații!";
                        unset($_SESSION['title']);
                    } else {
                        $title = $_POST['chapterTitle'];
                        $_SESSION['title'] = $title;
                        if (isset($_POST['chapter_type']) && ($_POST['chapter_type'] == 1 || $_POST['chapter_type'] == 2)) {
                            $chapter_type = $_POST['chapter_type'];
                            $_SESSION['chapter_type'] = $chapter_type;
                            if ($chapter_type == 2 && array_filter($chapter['subsections'])) {
                                while ($chapter['subsections']) {
                                    array_pop($chapter['subsections']);
                                    $subsection = '';
                                }
                            }
                            if (isset($_POST['chapterpoints']) && ($_POST['chapterpoints'] > 0)) {
                                $chapterpoints = $_POST['chapterpoints'];
                                $_SESSION['chapterpoints'] = $chapterpoints;
                            } else {
                                $errors['chapter'] = "Trebuie să ai un număr de puncte!";
                            }
                        } else {
                            $errors['chapter'] = "Trebuie să selectezi tipul capitolului!";
                        }
                    }
                }
                if (!$errors['chapter'] && !$errors['chapterTitle']) {
                    $ok = 1;
                    $_SESSION['ok'] = 1;
                } else {
                    $ok = 0;
                    $_SESSION['ok'] = 0;
                }
            }

            if (isset($_POST['add_subsection'])) {
                if (!empty($_POST['type']) && ($_POST['type'] == 1 || $_POST['type'] == 2 || $_POST['type'] == 3 || $_POST['type'] == 4 || $_POST['type'] == 5 || $_POST['type'] == 6 || $_POST['type'] == 7 || $_POST['type'] == 9 || $_POST['type'] == 10)) {
                    $subsection['type'] = $_POST['type'];
                    $_SESSION['subsection'] = $subsection;
                } else {
                    $errors['subsection'] = "Trebuie să alegi ceva!";
                }
            }
            if (isset($_POST['add_top_landsc'])) {
                if ($_FILES['top_landsc']['size'] != 0) {
                    $top_landsc = $_FILES['top_landsc'];
                    $top_landscName = $_FILES['top_landsc']['name'];
                    $top_landscType = $_FILES['top_landsc']['type'];
                    $top_landscNameTmp = $_FILES['top_landsc']['tmp_name'];
                    $top_landscError = $_FILES['top_landsc']['error'];
                    $top_landscSize = $_FILES['top_landsc']['size'];

                    $top_landscExt = explode('.', $top_landscName);
                    $top_landscActualExt = strtolower(end($top_landscExt));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($top_landscActualExt, $allowed)) {
                        if ($top_landscError === 0) {
                            if ($top_landscSize < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                // if (empty($_POST['top_landsc_txt'])) {
                                //     // $errors['top_landsc'] = "Trebuie să ai o descriere!";
                                // } else 
                                {
                                    $top_landscDest = "./img/" . $top_landscName;
                                    move_uploaded_file($top_landscNameTmp, $top_landscDest);
                                    $subsection['image'] = $top_landscDest;
                                    $subsection['text'] = $_POST['top_landsc_txt'];
                                    array_push($chapter['subsections'], $subsection);
                                    $_SESSION['chapter'] = $chapter;
                                    $_SESSION['ok'] = 1;
                                    unset($_SESSION['subsection']);
                                    header('Location: form.php');
                                }
                            } else {
                                $errors['top_landsc'] = "Fișierul tău este prea mare!";
                            }
                        } else {
                            $errors['top_landsc'] = "Am întâmpinat o eroare!";
                        }
                    } else {
                        $errors['top_landsc'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['top_landsc'] = "Trebuie să pui și o imagine!";
                }
            }

            //verificare left landscape
            if (isset($_POST['add_left_landsc'])) {
                if ($_FILES['left_landsc']['size'] != 0) {
                    $left_landsc = $_FILES['left_landsc'];
                    $left_landscName = $_FILES['left_landsc']['name'];
                    $left_landscType = $_FILES['left_landsc']['type'];
                    $left_landscNameTmp = $_FILES['left_landsc']['tmp_name'];
                    $left_landscError = $_FILES['left_landsc']['error'];
                    $left_landscSize = $_FILES['left_landsc']['size'];

                    $left_landscExt = explode('.', $left_landscName);
                    $left_landscActualExt = strtolower(end($left_landscExt));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($left_landscActualExt, $allowed)) {
                        if ($left_landscError === 0) {
                            if ($left_landscSize < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['left_landsc_txt'])) {
                                    $errors['left_landsc'] = "Trebuie să ai și o descriere!";
                                } else {
                                    $left_landscDest = "./img/" . $left_landscName;
                                    move_uploaded_file($left_landscNameTmp, $left_landscDest);
                                    $subsection['image'] = $left_landscDest;
                                    $subsection['text'] = $_POST['left_landsc_txt'];
                                    array_push($chapter['subsections'], $subsection);
                                    $_SESSION['chapter'] = $chapter;
                                    $_SESSION['ok'] = 1;
                                    unset($_SESSION['subsection']);
                                    header('Location: form.php');
                                }
                            } else {
                                $errors['left_landsc'] = "Fișierul tău este prea mare!";
                            }
                        } else {
                            $errors['left_landsc'] = "Am întâmpinat o eroare!";
                        }
                    } else {
                        $errors['left_landsc'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['left_landsc'] = "Trebuie să pui și o imagine!";
                }
            } else {
                $_SESSION['ok'] = 0;
            }


            //verificare rirightlandscape
            if (isset($_POST['add_right_landsc'])) {
                if ($_FILES['right_landsc']['size'] != 0) {
                    $right_landsc = $_FILES['right_landsc'];
                    $right_landscName = $_FILES['right_landsc']['name'];
                    $right_landscType = $_FILES['right_landsc']['type'];
                    $right_landscNameTmp = $_FILES['right_landsc']['tmp_name'];
                    $right_landscError = $_FILES['right_landsc']['error'];
                    $right_landscSize = $_FILES['right_landsc']['size'];

                    $right_landscExt = explode('.', $right_landscName);
                    $right_landscActualExt = strtolower(end($right_landscExt));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($right_landscActualExt, $allowed)) {
                        if ($right_landscError === 0) {
                            if ($right_landscSize < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['right_landsc_txt'])) {
                                    $errors['right_landsc'] = "Trebuie să ai și o descriere!";
                                } else {
                                    $right_landscDest = "./img/" . $right_landscName;
                                    move_uploaded_file($right_landscNameTmp, $right_landscDest);
                                    $subsection['image'] = $right_landscDest;
                                    $subsection['text'] = $_POST['right_landsc_txt'];
                                    array_push($chapter['subsections'], $subsection);
                                    $_SESSION['chapter'] = $chapter;
                                    $_SESSION['ok'] = 1;
                                    unset($_SESSION['subsection']);
                                    header('Location: form.php');
                                }
                            } else {
                                $errors['right_landsc'] = "Fișierul tău este prea mare!";
                            }
                        } else {
                            $errors['right_landsc'] = "Am întâmpinat o eroare!";
                        }
                    } else {
                        $errors['right_landsc'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['right_landsc'] = "Trebuie să ai și o imagine!";
                }
            } else {
                $_SESSION['ok'] = 0;
            }


            //verificare left portrait
            if (isset($_POST['add_left_portrait'])) {
                if ($_FILES['left_portrait']['size'] != 0) {
                    $left_portrait = $_FILES['left_portrait'];
                    $left_portraitName = $_FILES['left_portrait']['name'];
                    $left_portraitType = $_FILES['left_portrait']['type'];
                    $left_portraitNameTmp = $_FILES['left_portrait']['tmp_name'];
                    $left_portraitError = $_FILES['left_portrait']['error'];
                    $left_portraitSize = $_FILES['left_portrait']['size'];

                    $left_portraitExt = explode('.', $left_portraitName);
                    $left_portraitActualExt = strtolower(end($left_portraitExt));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($left_portraitActualExt, $allowed)) {
                        if ($left_portraitError === 0) {
                            if ($left_portraitSize < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['left_portrait_txt'])) {
                                    $errors['left_portrait'] = "Trebuie să ai și o descriere!";
                                } else {
                                    $left_portraitDest = "./img/" . $left_portraitName;
                                    move_uploaded_file($left_portraitNameTmp, $left_portraitDest);
                                    $subsection['image'] = $left_portraitDest;
                                    $subsection['text'] = $_POST['left_portrait_txt'];
                                    array_push($chapter['subsections'], $subsection);
                                    $_SESSION['chapter'] = $chapter;
                                    $_SESSION['ok'] = 1;
                                    unset($_SESSION['subsection']);
                                    header('Location: form.php');
                                }
                            } else {
                                $errors['left_portrait'] = "Fișierul tău este prea mare!";
                            }
                        } else {
                            $errors['left_portrait'] = "Am întâmpinat o eroare!!";
                        }
                    } else {
                        $errors['left_portrait'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['left_portrait'] = "Trebuie sa pui si o imagine!";
                }
            } else {
                $_SESSION['ok'] = 0;
            }

            //verificare right portrait
            if (isset($_POST['add_right_portrait'])) {
                if ($_FILES['right_portrait']['size'] != 0) {
                    $right_portrait = $_FILES['right_portrait'];
                    $right_portraitName = $_FILES['right_portrait']['name'];
                    $right_portraitType = $_FILES['right_portrait']['type'];
                    $right_portraitNameTmp = $_FILES['right_portrait']['tmp_name'];
                    $right_portraitError = $_FILES['right_portrait']['error'];
                    $right_portraitSize = $_FILES['right_portrait']['size'];

                    $right_portraitExt = explode('.', $right_portraitName);
                    $right_portraitActualExt = strtolower(end($right_portraitExt));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($right_portraitActualExt, $allowed)) {
                        if ($right_portraitError === 0) {
                            if ($right_portraitSize < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['right_portrait_txt'])) {
                                    $errors['right_portrait'] = "Trebuie să pui și o descriere!";
                                } else {
                                    $right_portraitDest = "./img/" . $right_portraitName;
                                    move_uploaded_file($right_portraitNameTmp, $right_portraitDest);
                                    $subsection['image'] = $right_portraitDest;
                                    $subsection['text'] = $_POST['right_portrait_txt'];
                                    array_push($chapter['subsections'], $subsection);
                                    $_SESSION['chapter'] = $chapter;
                                    $_SESSION['ok'] = 1;
                                    unset($_SESSION['subsection']);
                                    header('Location: form.php');
                                }
                            } else {
                                $errors['right_portrait'] = "Fișierul tău este prea mare!";
                            }
                        } else {
                            $errors['right_portrait'] = "Am întâmpinat o eroare!";
                        }
                    } else {
                        $errors['right_portrait'] = "Se pot încărca doar imagini!";
                    }
                } else {
                    $errors['right_portrait'] = "Trebuie să pui și o imagine!";
                }
            }

            //versquare
            if (isset($_POST['add_square'])) {
                $verif = 1;
                if ($_FILES['square1']['size'] != 0) {
                    $square1 = $_FILES['square1'];
                    $squareName1 = $_FILES['square1']['name'];
                    $squareType1 = $_FILES['square1']['type'];
                    $squareNameTmp1 = $_FILES['square1']['tmp_name'];
                    $squareError1 = $_FILES['square1']['error'];
                    $squareSize1 = $_FILES['square1']['size'];

                    $squareExt1 = explode('.', $squareName1);
                    $squareActualExt1 = strtolower(end($squareExt1));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($squareActualExt1, $allowed)) {
                        if ($squareError1 === 0) {
                            if ($squareSize1 < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['square_txt1'])) {
                                    $errors['square1'] = "Trebuie să pui și o descriere!";

                                    $verif = 0;
                                } else {
                                    $squareDest1 = "./img/" . $squareName1;
                                }
                            } else {
                                $errors['square1'] = "Fișierul tău este prea mare!";

                                $verif = 0;
                            }
                        } else {
                            $errors['square1'] = "Am întâmpinat o eroare!";

                            $verif = 0;
                        }
                    } else {
                        $errors['square1'] = "Se pot încărca doar imagini!";

                        $verif = 0;
                    }
                } else {
                    $errors['square1'] = "Trebuie să ai și o imagine!";

                    $verif = 0;
                }

                if ($_FILES['square2']['size'] != 0) {
                    $square2 = $_FILES['square2'];
                    $squareName2 = $_FILES['square2']['name'];
                    $squareType2 = $_FILES['square2']['type'];
                    $squareNameTmp2 = $_FILES['square2']['tmp_name'];
                    $squareError2 = $_FILES['square2']['error'];
                    $squareSize2 = $_FILES['square2']['size'];

                    $squareExt2 = explode('.', $squareName2);
                    $squareActualExt2 = strtolower(end($squareExt2));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($squareActualExt2, $allowed)) {
                        if ($squareError2 === 0) {
                            if ($squareSize2 < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['square_txt2'])) {
                                    $errors['square2'] = "Trebuie să pui și o descriere!";

                                    $verif = 0;
                                } else {
                                    $squareDest2 = "./img/" . $squareName2;
                                }
                            } else {
                                $errors['square2'] = "Fișierul tău este prea mare!";

                                $verif = 0;
                            }
                        } else {
                            $errors['square2'] = "Am întâmpinat o eroare!";

                            $verif = 0;
                        }
                    } else {
                        $errors['square2'] = "Se pot încărca doar imagini!";

                        $verif = 0;
                    }
                } else {
                    $errors['square2'] = "Trebuie să pui și o imagine!";

                    $verif = 0;
                }
                if ($_FILES['square3']['size'] != 0) {
                    $square3 = $_FILES['square3'];
                    $squareName3 = $_FILES['square3']['name'];
                    $squareType3 = $_FILES['square3']['type'];
                    $squareNameTmp3 = $_FILES['square3']['tmp_name'];
                    $squareError3 = $_FILES['square3']['error'];
                    $squareSize3 = $_FILES['square3']['size'];

                    $squareExt3 = explode('.', $squareName3);
                    $squareActualExt3 = strtolower(end($squareExt3));

                    $allowed = ['jpg', 'jpeg', 'png'];

                    if (in_array($squareActualExt3, $allowed)) {
                        if ($squareError3 === 0) {
                            if ($squareSize3 < 500000000) {
                                // $fileNewName = uniqid('', true) . "." . $fileActualExt; //creates a unique id based on the current timestamp in microseconds

                                if (empty($_POST['square_txt3'])) {
                                    $errors['square3'] = "Trebuie să pui și o descriere!";

                                    $verif = 0;
                                } else {
                                    $squareDest3 = "./img/" . $squareName3;
                                }
                            } else {
                                $errors['square3'] = "Fișierul tău este prea mare!";

                                $verif = 0;
                            }
                        } else {
                            $errors['square3'] = "Am întâmpinat o eroare!";

                            $verif = 0;
                        }
                    } else {
                        $errors['square3'] = "Se pot încărca doar imagini!";

                        $verif = 0;
                    }
                } else {
                    $errors['square3'] = "Trebuie să pui și o imagine!";

                    $verif = 0;
                }



                if ($verif == 1) {
                    move_uploaded_file($squareNameTmp1, $squareDest1);
                    move_uploaded_file($squareNameTmp2, $squareDest2);
                    move_uploaded_file($squareNameTmp3, $squareDest3);
                    $subsection['image'] = $squareDest1 . ";" . $squareDest2 . ";" . $squareDest3;
                    $subsection['text'] = $_POST['square_txt1'] . ";;;" . $_POST['square_txt2'] . ";;;" . $_POST['square_txt3'];
                    array_push($chapter['subsections'], $subsection);
                    $_SESSION['chapter'] = $chapter;
                    $_SESSION['ok'] = 1;
                    unset($_SESSION['subsection']);
                    header('Location: form.php');
                }
            }

            //verif plain text

            if (isset($_POST['add_plain_txt'])) {
                if (empty($_POST['plain_txt'])) {
                    $errors['plaint_txt'] = "Trebuie să pui text aici!";
                } else {
                    $subsection['image'] = '';
                    $subsection['text'] = $_POST['plain_txt'];
                    array_push($chapter['subsections'], $subsection);
                    $_SESSION['chapter'] = $chapter;
                    $_SESSION['ok'] = 1;
                    unset($_SESSION['subsection']);
                    header('Location: form.php');
                }
            }
            if (isset($_POST['add_subtitle'])) {
                if (empty($_POST['subtitle'])) {
                    $errors['subtitle'] = "Trebuie să pui text aici!";
                } else {
                    $subtitle = $_POST['subtitle'];
                    $_SESSION['subtitle'] = $subtitle;
                    $subsection['image'] = '';
                    $subsection['text'] = $_POST['subtitle'];
                    array_push($chapter['subsections'], $subsection);
                    $_SESSION['chapter'] = $chapter;
                    $_SESSION['ok'] = 1;
                    unset($_SESSION['subsection']);
                    unset($_SESSION['subtitle']);
                    header('Location: form.php');
                }
            }
            if (isset($_POST['add_highlight'])) {
                if (empty($_POST['highlight'])) {
                    $errors['highlight'] = "Trebuie să pui ceva aici!";
                } else {
                    $highlight = $_POST['highlight'];
                    $_SESSION['highlight'] = $highlight;
                }

                if (!$errors['highlight']) {
                    $subsection['image'] = '';
                    $subsection['text'] = $highlight;
                    array_push($chapter['subsections'], $subsection);
                    $_SESSION['chapter'] = $chapter;
                    $_SESSION['ok'] = 1;
                    unset($_SESSION['subsection']);
                    unset($_SESSION['highlight']);
                    header('Location: form.php');
                }
            }

            //if chapter type is game, you need to upload a game url

            if (isset($_POST['submit_game_url'])) {
                if (empty($_POST['game_url'])) {
                    $errors['chapter'] = "Trebuie să indici jocul!";
                } else {
                    if (!preg_match('/^[a-zA-Z0-9_-]+\.(php|js)$/', $_POST['game_url'])) {
                        $errors['chapter'] = "Trebuie să pui un link valid!";
                    } else {
                        $subsection['type'] = 8;
                        $_SESSION['subsection'] = $subsection;
                        $game_url = $_POST['game_url'];
                        $_SESSION['game_url'] = $game_url;
                    }
                }
            }

            //adding a chapter
            if (isset($_POST['add_chapter'])) {
                if (!$title) {
                    $errors['chapterTitle'] = "Capitolul trebuie să aibă un titlu!";
                } else {
                    if (!preg_match('/^([a-zA-Z?!.]+\s)*[a-zA-Z?!.]+$/', $title)) {
                        $errors['chapterTitle'] = "Nu știu cum ai trecut de erorile de până acum, dar trebuie un titlu doar cu litere!";
                    }
                }
                if (!$chapter_type) {
                    $errors['chapter'] = "Trebuie să selectezi tipul capitolului!";
                } else if ($chapter_type == 1) {
                    if (array_filter($chapter['subsections'])) {
                    } else {
                        $errors['chapter'] = "Capitolul nu poate fi gol!";
                    }
                } else if ($chapter_type == 2) {

                    if (!$game_url) {
                        $errors['chapter'] = "Trebuie sa indici jocul!";
                    } else {
                        $subsection['image'] = '';
                        $subsection['text'] = "./games/" . $game_url;
                        array_push($chapter['subsections'], $subsection);
                        $_SESSION['chapter'] = $chapter;
                        $_SESSION['ok'] = 1;
                        unset($_SESSION['subsection']);
                    }
                }
                if ($chapterpoints <= 0) {
                    $errors['chapter'] = "Trebuie să setezi numărul de puncte!";
                }
                if (array_filter($errors)) {
                } else {
                    $chapter['title'] = $title;
                    $chapter['type'] = $chapter_type;
                    $chapter['points'] = $chapterpoints;

                    array_push($chapters, $chapter);
                    $_SESSION['chapters'] = $chapters;
                    unset($_SESSION['chapter']);
                    unset($_SESSION['subsection']);
                    unset($_SESSION['chapter_type']);
                    unset($_SESSION['chapterpoints']);
                    unset($_SESSION['game_url']);
                    $_SESSION['ok'] = 0;
                    unset($_SESSION['title']);
                    header('Location: form.php');
                }
            }

            //delete subsection
            if (($chapter)) {
                $n = 0;
                foreach ($chapter['subsections'] as $c) {
                    $n++;
                }
                for ($i = 0; $i <= $n; $i++) {
                    if (isset($_POST['delete' . $i])) {
                        array_splice($chapter['subsections'], $i, 1);
                        $_SESSION['chapter'] = $chapter;
                    }
                }
            }

            //calculate total points
            $course_points = calcpoints($chapters);


            //upload all course
            if (isset($_POST['submit_course'])) {

                if (!isset($_SESSION['cover_name'])) {
                    $errors['course'] = "Trebuie să pui o imagine de fundal!";
                }
                if (empty($_POST['courseTitle'])) {
                    $errors['courseTitle'] = "Trebuie să pui un titlu!";
                } else {
                    if (!preg_match('/^([a-zA-Z?!.]+\s)*[a-zA-Z?!.]+$/', $_POST['courseTitle'])) {
                        $errors['courseTitle'] = "Titlul cursului poate conține doar litere și spații!";
                        unset($_SESSION['courseTitle']);
                    } else {
                        $courseTitle = $_POST['courseTitle'];
                        $_SESSION['courseTitle'] = $_POST['courseTitle'];
                    }
                    if (array_filter($chapters)) {
                    } else {
                        $errors['course'] = "Nu poți încărca un curs gol!";
                    }
                    if (empty($_POST['intro'])) {
                        $errors['course'] = "Trebuie intro!";
                    } else {
                        $intro = $_POST['intro'];
                        $_SESSION['intro'] = $intro;
                    }
                    if (empty($_POST['color'])) {
                        $errors['course'] = "Trebuie să o culoare de fundal!";
                    } else if (!preg_match('/^#{1}([a-zA-Z0-9]{6}|[a-zA-Z0-9]{3})$/', $_POST['color'])) {
                        $errors['course'] = "Culoarea trebuie sa fie în format hexadecimal!";
                    } else {
                        $color = $_POST['color'];
                        $_SESSION['color'] = $color;
                    }
                    if (array_filter($errors)) {
                    } else {
                        if ($course_points <= 0) {
                            $errors['course'] = "ceva nu e bine cu punctele!";
                        } else {
                            $test = new Courses();
                            $dest = $_SESSION['cover_dest'];
                            //unset sessions
                            unset($_SESSION['cover_name']);
                            unset($_SESSION['cover_dest']);
                            unset($_SESSION['chapter']);
                            unset($_SESSION['subsection']);
                            unset($_SESSION['chapter_type']);
                            unset($_SESSION['chapterpoints']);
                            unset($_SESSION['game_url']);
                            unset($_SESSION['title']);
                            unset($_SESSION['courseTitle']);
                            unset($_SESSION['intro']);
                            unset($_SESSION['chapters']);
                            unset($_SESSION['color']);
                            unset($_SESSION['highlight']);
                            unset($_SESSION['subtitle']);
                            $_SESSION['ok'] = 0;


                            try {
                                $test->setCourses($courseTitle,  $intro, $dest,  $course_points, $chapters, $color);
                                header('Location: form.php');
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                        }
                    }
                }
            }

            //starting over
            if (isset($_POST['delete_all'])) {
                unset($_SESSION['cover_name']);
                unset($_SESSION['cover_dest']);
                unset($_SESSION['chapter']);
                unset($_SESSION['subsection']);
                unset($_SESSION['chapter_type']);
                unset($_SESSION['chapterpoints']);
                unset($_SESSION['game_url']);
                unset($_SESSION['title']);
                unset($_SESSION['courseTitle']);
                unset($_SESSION['intro']);
                unset($_SESSION['chapters']);
                unset($_SESSION['color']);
                unset($_SESSION['highlight']);
                unset($_SESSION['subtitle']);
                $_SESSION['ok'] = 0;

                header('Location: form.php');
            }

            if (array_filter($errors)) {
                $ok = 0;
                $_SESSION['ok'] = 0;
            }

    ?>

            <div class="content">
                <div class="right_content">
                    <?php
                    include('./templates/nav.php');
                    ?>
                    <div class="flex verticalflex course_form">
                        <h1 class="left_text purple_text">Adaugă un curs nou</h1>
                        <hr class="separator_dots">
                        <form action="form.php" method="post" enctype="multipart/form-data" id="add_course">
                            <div class="horizontal_section">
                                <div class="coursetitle flex verticalflex">
                                    <label for="coursetitle">Titlul cursului</label>
                                    <input type="text" name="courseTitle" id="" value="<?php echo $courseTitle; ?>">
                                </div>
                                <div class="flex verticalflex">
                                    <label for="color">Culoare</label>
                                    <input type="text" name="color" value="<?php echo $color; ?>">
                                </div>
                                <div class=" flex verticalflex">
                                    <label for="points">Număr de puncte</label>
                                    <!-- <input type="number" name="coursePoints" id="" value="0" min="0"> -->

                                    <h2 class="purple_text left_text" style="margin: 10px"><?php echo $course_points . " puncte" ?></h2>
                                </div>
                            </div>
                            <div class="errors">
                                <?php if (!empty($errors['courseTitle'])) {
                                    echo $errors['courseTitle'];
                                }
                                ?>
                            </div>
                            <label for="coursedetails">Adaugă detaliile cursului</label>
                            <div class="horizontal_section">
                                <div class="drop-zone left_landsc cover" id="">
                                    <?php if (isset($_SESSION['cover_name'])) { ?>
                                        <div class="drop-zone__thumb" data-label="<?php echo $_SESSION['cover_name']; ?> " style="background-image: url(<?php echo $_SESSION['cover_dest']; ?>);"></div>
                                    <?php } else { ?>
                                        <div class="flex verticalflex prompt">
                                            <h2 class="">Imaginea de copertă</h2>
                                            <span class="">Aruncă imaginea aici sau dă click.</span>
                                        </div>

                                    <?php } ?>

                                    <form action="form.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="cover" id="" class="drop-zone__input ">
                                        <input type="submit" value="cover_submit" name="cover_submit" class="cover_submit drop_submit">
                                    </form>
                                </div>
                                <textarea name="intro" id="" cols="30" rows="10" class="txt" placeholder="Aici trebuie să pui introducerea pentru acest curs."><?php echo $intro; ?></textarea>
                            </div>
                            <div class="errors">
                                <?php if (!empty($errors['course'])) {
                                    echo $errors['course'];
                                }
                                ?>
                            </div>
                            <h2 class="purple_text left_text">
                                Capitole adăugate
                            </h2>
                            <?php if (array_filter($chapters)) {
                                $x = 1;
                                foreach ($chapters as $chap) {
                            ?>
                                    <div class="horizontal_section" style="align-items: center; justify-content: space-between">
                                        <h2 class="purple_text coursetitle_H1"><?php echo $x . ". " . $chap['title'] . " - " . $chap['points'] . "points";
                                                                                $x++; ?></h2>
                                        <!-- <button>MORE</button> -->
                                    </div>

                            <?php }
                            } ?>
                            <hr class="separator_dots">
                            <!-- <form action="form.php" method="POST" id="delete_cover">
            <input type="submit" name="delete_cover" class="buton" value="STERGE" form="delete_cover"></button>
        </form> -->
                            <h2 class="purple_text left_text">Adaugă capitole noi</h2>
                            <form action="form.php" method="post" id="select_type">
                                <div class="horizontal_section">
                                    <div class="flex verticalflex">
                                        <label for="chapterTitle">Titlul capitolului</label>
                                        <input type="text" name="chapterTitle" id="" value="<?php echo $title; ?>">

                                    </div>
                                    <div class="flex verticalflex">
                                        <label for="chapter_type">Tipul capitolului</label>
                                        <select name="chapter_type" id="">
                                            <option value="" disabled <?php if ($chapter_type == 0) {
                                                                            echo 'selected';
                                                                        } ?>>Alege tipul capitolului</option>
                                            <option value="1" <?php if ($chapter_type == 1) {
                                                                    echo 'selected';
                                                                } ?>>Text și imagini</option>
                                            <option value="2" <?php if ($chapter_type == 2) {
                                                                    echo 'selected';
                                                                } ?>>Joc</option>
                                        </select>
                                    </div>

                                    <div class="flex verticalflex">
                                        <label for="chapterpoints">Nr. puncte</label>
                                        <input type="number" name="chapterpoints" id="" value="<?php echo $chapterpoints; ?>" min="0">
                                    </div>


                                </div>
                                <div><button value="Începe capitolul" name="start_chapter" form="select_type">Începe capitolul</button></div>
                                <div class="errors">
                                    <?php if (!empty($errors['chapter'])) {
                                        echo $errors['chapter'];
                                    }
                                    ?>
                                </div>
                                <div class="errors">
                                    <?php if (!empty($errors['chapterTitle'])) {
                                        echo $errors['chapterTitle'];
                                    }
                                    ?>
                                </div>

                            </form>
                            <!-- Show progress -->
                            <?php if (array_filter($chapter['subsections'])) {
                                $i = 0;
                                foreach ($chapter['subsections'] as $sub) {

                                    switch ($sub['type']) {
                                        case 1: ?>
                                            <div class="flex verticalflex">
                                                <div class="top_landsc_img">
                                                    <img src="<?php echo $sub['image']; ?>" alt="" class="top_landsc_img">
                                                </div>

                                                <div class="top_landsc_txt">
                                                    <p><?php echo $sub['text']; ?></p>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>

                                        <?php
                                            break;
                                        case 2: ?>
                                            <div>
                                                <div class="horizontal_section">
                                                    <div class="left_landsc_img">
                                                        <img src="<?php echo $sub['image']; ?>" alt="" class="img">
                                                    </div>

                                                    <div class="left_landsc_txt">
                                                        <p><?php echo $sub['text']; ?></p>
                                                    </div>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>

                                        <?php
                                            break;
                                        case 3: ?>
                                            <div>
                                                <div class="horizontal_section">
                                                    <div class="right_landsc_txt">
                                                        <p><?php echo $sub['text']; ?></p>
                                                    </div>
                                                    <div class="right_landsc_img">
                                                        <img src="<?php echo $sub['image']; ?>" alt="" class="img">
                                                    </div>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 4: ?>
                                            <div>
                                                <div class="horizontal_section">

                                                    <div class="left_portrait_img">
                                                        <img src="<?php echo $sub['image']; ?>" alt="" class="img">
                                                    </div>
                                                    <div class="left_portrait_txt">
                                                        <p><?php echo $sub['text']; ?></p>
                                                    </div>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 5: ?>
                                            <div>
                                                <div class="horizontal_section">
                                                    <div class="right_portrait_txt">
                                                        <p><?php echo $sub['text']; ?></p>
                                                    </div>
                                                    <div class="right_portrait_img">
                                                        <img src="<?php echo $sub['image']; ?>" alt="" class="img">
                                                    </div>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 6: ?>
                                            <div>
                                                <div class=" flex three_square">
                                                    <?php $imgs = explode(";", $sub['image']);
                                                    $txts = explode(";;;", $sub['text']);
                                                    $j = 0;
                                                    foreach ($imgs as $img) { ?>
                                                        <div class="flex verticalflex square_section">
                                                            <div class="square_img">
                                                                <img src="<?php echo $img; ?>" alt="" class="img">
                                                            </div>
                                                            <div class="square_txt">
                                                                <h3><?php echo $txts[$j];
                                                                    $j++; ?></h3>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>

                                            </div>

                                        <?php
                                            break;
                                        case 7: ?>
                                            <div class="flex verticalflex">

                                                <div class="plain_txt">
                                                    <p><?php echo $sub['text']; ?></p>
                                                </div>

                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 8: ?>
                                            <div class="flex verticalflex">

                                                <div class="plain_txt">
                                                    <p><?php echo $sub['text']; ?></p>
                                                </div>

                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 9: ?>
                                            <div class="flex verticalflex">

                                                <div class="highlight" style="background-color: <?php echo $color; ?>;">
                                                    <p><?php echo $sub['text']; ?></p>
                                                </div>

                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                                        <?php
                                            break;
                                        case 10: ?>
                                            <div class="flex verticalflex">


                                                <h3><?php echo $sub['text']; ?></h3>


                                                <form action="form.php" method="post" id="<?php echo $i; ?>">
                                                    <input type="submit" value="DELETE" name="delete<?php echo $i; ?>" form="<?php echo $i; ?>">
                                                </form>
                                            </div>
                            <?php
                                            break;
                                    }
                                    $i++;
                                }
                            } ?>



                            <?php if ($chapter_type == 1 && $ok == 1) {

                            ?>
                                <form action="form.php" method="POST" id="type">
                                    <div class="horizontal_section">
                                        <div class=" flex verticalflex">
                                            <label for="type">Selectează tipul subsecțiunii</label>
                                            <select name="type" id="">
                                                <option value="" disabled <?php if (!$subsection['type']) {
                                                                                echo 'selected';
                                                                            } ?>>Alege un layout</option>
                                                <option value="1" <?php if ($subsection['type'] == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Landscape sus</option>
                                                <option value="2" <?php if ($subsection['type'] == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Landscape stânga</option>
                                                <option value="3" <?php if ($subsection['type'] == 3) {
                                                                        echo 'selected';
                                                                    } ?>>Landscape dreapta</option>
                                                <option value="4" <?php if ($subsection['type'] == 4) {
                                                                        echo 'selected';
                                                                    } ?>>Portret stânga</option>
                                                <option value="5" <?php if ($subsection['type'] == 5) {
                                                                        echo 'selected';
                                                                    } ?>>Portret dreapta</option>
                                                <option value="6" <?php if ($subsection['type'] == 6) {
                                                                        echo 'selected';
                                                                    } ?>>Trei pătrate</option>
                                                <option value="7" <?php if ($subsection['type'] == 7) {
                                                                        echo 'selected';
                                                                    } ?>>Doar text</option>
                                                <option value="9" <?php if ($subsection['type'] == 9) {
                                                                        echo 'selected';
                                                                    } ?>>Highlight</option>
                                                <option value="10" <?php if ($subsection['type'] == 10) {
                                                                        echo 'selected';
                                                                    } ?>>Subtitlu</option>

                                            </select>
                                        </div>
                                        <input type="submit" value="Începe completarea" name="add_subsection" form="type" style="align-self: flex-end;">
                                    </div>

                                </form>
                                <div class="errors"><?php if ($errors['subsection']) {
                                                        echo $errors['subsection'];
                                                    } ?></div>
                            <?php } else if ($chapter_type == 2) { ?>
                                <form action="form.php" method="post">
                                    <div class="flex verticalflex">

                                        <label for="game_url">Linkul pentru joc</label>
                                        <input type="text" name="game_url" id="" placeholder="Linkul pentru joc" value="<?php echo $game_url; ?>">
                                        <input type="submit" value="Confirma" name="submit_game_url">
                                    </div>
                                </form>

                            <?php } ?>
                            <?php if ($chapter_type == 1) {
                                if (array_filter($subsection)) {
                                    switch ($subsection['type']) {

                                            //top landscape
                                        case 1:  ?>

                                            <form action="form.php" method="post" enctype="multipart/form-data" id="top_landsc">
                                                <div class="flex verticalflex">
                                                    <div class="drop-zone top_landsc" id=""><span class="prompt">Aruncă imaginea aici sau dă click.</span>

                                                        <input type="file" name="top_landsc" id="" class="drop-zone__input">

                                                    </div>
                                                    <textarea name="top_landsc_txt" id="" cols="30" rows="10" placeholder="Aici vei trece tot textul pentru această subsecțiune" class="top_landsc_txt"></textarea>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['top_landsc'])) {
                                                        echo $errors['top_landsc'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_top_landsc" form="top_landsc">
                                            </form>

                                        <?php
                                            break;

                                            //left landscape
                                        case 2:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="left_landsc">
                                                <div class="horizontal_section">
                                                    <div class="drop-zone left_landsc small" id=""><span class="prompt">Aruncă imaginea aici sau dă click.</span>
                                                        <input type="file" name="left_landsc" id="" class="drop-zone__input">
                                                    </div>
                                                    <textarea name="left_landsc_txt" id="" cols="30" rows="10" placeholder="Aici vei trece tot textul pentru această subsecțiune"></textarea>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['left_landsc'])) {
                                                        echo $errors['left_landsc'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_left_landsc" form="left_landsc">
                                            </form>
                                        <?php
                                            break;

                                            //right landscape
                                        case 3:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="right_landsc">
                                                <div class="horizontal_section">
                                                    <textarea name="right_landsc_txt" class="right_landsc_txt" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune"></textarea>
                                                    <div class="drop-zone right_landsc right_landsc_img" id="">
                                                        <span class="prompt">Arunca imaginea aici sau da click.</span>
                                                        <input type="file" name="right_landsc" id="" class="drop-zone__input">
                                                    </div>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['right_landsc'])) {
                                                        echo $errors['right_landsc'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_right_landsc" form="right_landsc">
                                                <?php echo $subsection['type']; ?>
                                            </form>
                                        <?php
                                            break;

                                            //left portrait
                                        case 4:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="left_portrait">
                                                <div class="horizontal_section">
                                                    <div class="drop-zone left_portrait" id="">
                                                        <span class="prompt">Arunca imaginea aici sau da click.</span>
                                                        <input type="file" name="left_portrait" id="" class="drop-zone__input">
                                                    </div>
                                                    <textarea name="left_portrait_txt" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="left_portrait_txt"></textarea>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['left_portrait'])) {
                                                        echo $errors['left_portrait'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_left_portrait" form="left_portrait">
                                            </form>
                                        <?php
                                            break;
                                            //right portrait
                                        case 5:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="right_portrait">
                                                <div class="horizontal_section">
                                                    <textarea name="right_portrait_txt" class="right_portrait_txt" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune"></textarea>
                                                    <div class="drop-zone right_portrait" id=""><span class="prompt">Arunca imaginea aici sau da click.</span>
                                                        <input type="file" name="right_portrait" id="" class="drop-zone__input">
                                                    </div>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['right_portrait'])) {
                                                        echo $errors['right_portrait'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_right_portrait" form="right_portrait">
                                                <?php echo $subsection['type']; ?>
                                            </form>
                                        <?php
                                            break;
                                            //three squares
                                        case 6:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="square">
                                                <div class="flex three_square">
                                                    <div class="flex verticalflex square_section">
                                                        <div class="drop-zone square" id=""><span class="prompt">Arunca imaginea aici sau da click.</span>
                                                            <input type="file" name="square1" id="" class="drop-zone__input">
                                                        </div>
                                                        <textarea name="square_txt1" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="square_txt"></textarea>
                                                        <div class="errors">
                                                            <?php if (!empty($errors['square1'])) {
                                                                echo $errors['square1'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex verticalflex">
                                                        <div class="drop-zone square" id=""><span class="prompt">Arunca imaginea aici sau da click.</span>
                                                            <input type="file" name="square2" id="" class="drop-zone__input">
                                                        </div>
                                                        <textarea name="square_txt2" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="square_txt"></textarea>
                                                        <div class="errors">
                                                            <?php if (!empty($errors['square2'])) {
                                                                echo $errors['square2'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex verticalflex">
                                                        <div class="drop-zone square" id=""><span class="prompt">Arunca imaginea aici sau da click.</span>
                                                            <input type="file" name="square3" id="" class="drop-zone__input">
                                                        </div>
                                                        <textarea name="square_txt3" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="square_txt"></textarea>
                                                        <div class="errors">
                                                            <?php if (!empty($errors['square3'])) {
                                                                echo $errors['square3'];
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_square" form="square">
                                            </form>
                                        <?php
                                            break;

                                            //plain text
                                        case 7:  ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="plain_txt">
                                                <div class="flex">
                                                    <textarea name="plain_txt" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="top_landsc_txt"></textarea>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_plain_txt" form="plain_txt">
                                            </form>
                                        <?php
                                            break;

                                            //highlight
                                        case 9:
                                        ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="highlight">

                                                <div class="flex">
                                                    <textarea name="highlight" id="" cols="30" rows="10" placeholder="aici treci tot ce tine de aceasta subsectiune" class="top_landsc_txt"><?php echo $highlight; ?></textarea>
                                                </div>
                                                <div class="errors">
                                                    <?php if (!empty($errors['highlight'])) {
                                                        echo $errors['highlight'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subsecțiune" name="add_highlight" form="highlight">
                                            </form>
                                        <?php
                                            break;
                                        case 10:
                                        ?>
                                            <form action="form.php" method="post" enctype="multipart/form-data" id="subtitle">

                                                <input type="text" name="subtitle" id="" value="<?php echo $subtitle; ?>"></input>

                                                <div class="errors">
                                                    <?php if (!empty($errors['subtitle'])) {
                                                        echo $errors['subtitle'];
                                                    }
                                                    ?>
                                                </div>
                                                <input type="submit" value="Adaugă subtitlu" name="add_subtitle" form="subtitle">
                                            </form>
                            <?php
                                            break;
                                        default:
                                            0;
                                    }
                                }
                            } ?>
                            <?php if ($ok == 1) {
                                $_SESSION['ok'] = 1; ?>
                                <form action="form.php" method="post" id="add_chapter">
                                    <input type="submit" value="Adaugă capitolul" name="add_chapter" form="add_chapter">
                                </form>
                            <?php } ?>
                            <div class="flex">
                                <input type="submit" value="Incarca!" name="submit_course" class="buton" form="add_course">
                            </div>

                        </form>
                        <form action="form.php" method="post">
                            <input type="submit" value="Sterge tot" name="delete_all">
                        </form>
                    </div>

                    <script src="./js/drop.js"></script>
            <?php

            include('./templates/footer.php');
        } else {
            header('Location: Errors/404.html');
        }
    } ?>