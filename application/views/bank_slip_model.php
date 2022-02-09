<!DOCTYPE html>
<html>
<head>
    <link href="<?=base_url("assets/vendors/bootstrap/css/bootstrap.css")?>" type="text/css" rel="stylesheet">
    <meta charset="utf-8">
    <title>{slip_num_id}</title>
    <style type="text/css">
    body { 
                        font-family: DejaVuSans;
                        font-size:35%; 
                    }

                *{
                    background: url(".base_url('favicon.png').") no-repeat center center fixed;
                }
                .row{
                    padding:1%;
                    padding-bottom:-6%;
                }

                .title{
                    font-size:8px;
                }

                h6{
                    display:block;
                    padding : 5px;
                    border-style: dotted;
                    border-color: blue;
                    border-left:none;
                    border-right:none;
                    border-width:1px;

                }

                hr{

                    color:red;
                }

                body,h1,h2,h3,h4,h5,h6{
                    font-family:monospace;
                    font-size:7px;
                }

                tr{
                    margin:2px;
                }

                table thead tr td{
                    font-family: monospace;
                }
                table tbody tr td{
                    font-family: monospace;
                }

                .gg, td{
                    font-size: 8px; font-family: 'monospace'; font-weight: bolder;
                }

                h6{
                    font-size:13px !important;
                }

                h4{
                    font-size:18px !important;
                }

                footer p{
                    font-size:5px;
                }
    </style>
</head>
    <body> 
        <div class="row">
            <p class="text-right text-danger"> Numero du recu : {slip_num_id}</p>
            <br>
            <p class="text-left text-danger">
               Complexe Scolaire Un Jour Nouveau
                <br>
                Ecole Primaire et secondaire
                <br>Perception par :{author}, Fonction :  {Fonction}
            </p>
            <p class="text-center title text-info">RECU DE PAIEMENT, <span class="text-right">{date}</span></p>
            <table class="table" style="border:none; font-size: 35%;">
                <tbody>
                    <tr class="gg">
                        <td>Lieu :</td>
                        <td>bureau du comptable</td>
                        <td class="text-danger">Montant total:</td>
                        <td class="title">{somme_total} $ (dollars americain)</td>
                    </tr>
                    <tr class="gg">
                        <td>Noms de l'eleve :</td>
                        <td class="text-info title">{nom_de_leleve}</td>
                        <td>Classe :</td>
                        <td class="text-info">{student_classe}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Motif</th>
                        <th>Somme Recu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Frais scolaire</td>
                        <td class="title">{minerval} $</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Frais de construction</td>
                        <td class="title">{construction} $</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Frais de bus</td>
                        <td class="title">{transport} $</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Frais de bibliotheque</td>
                        <td class="title">{bibliotheque} $</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Cantine </td>
                        <td class="title">{Quantine} $</td>
                    </tr>
                    </tbody>
            </table>
            
            <hr>
                <p class="text-left">Pour l'ecole, signature de l'auteur  et cachier
                <hr>
                <span class="text-left">
                    {copyright}
                </span>
                </p>
        </div>

    </body>
</html>
