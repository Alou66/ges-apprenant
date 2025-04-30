<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style7.css">
     <link rel="stylesheet" href="/assets/css/style5.css"> 
     <link rel="stylesheet" href="/assets/css/style9.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


    <title>Document</title>
</head>
<body>
    <div class="cont">
        <div class="conta">
            <div class="conta1">
                    <img src="/assets/images/son.png" alt="" srcset="">
                    <div class="promo">Promotion - 2025</div>
                    <div class="t"></div>
           </div> 
           <div class="conta2"> 
                    <a href="index.php?page=tab"><div class="tab"><span><i class="ri-dashboard-line icon"></i></span><span>Tableau de bord</span></div></a>
                    <a href="index.php?page=prom"><div class="tab"><span><i class="ri-folder-2-line icon"></i></span><span>Promotions</span></div></a>
                    <a href="index.php?page=ref"><div class="ref"><span><i class="ri-folder-2-line icon"></i></span><span>Référentiels</span></div></a>
                    <a href=""><div class="tab"><span><i class="ri-user-3-line icon"></i></span><span>Aprenants</span></div></a>
                    <a href=""><div class="tab"><span><i class="ri-calendar-check-line icon"></i></span><span>Gestion des présences</span></div></a>
                    <a href=""><div class="tab"><span><i class="ri-folder-2-line icon"></i></span><span>Kits et laptops</span></div></a>
                    <a href=""><div class="tab"><span><i class="ri-bar-chart-line icon"></i></span><span>Rapports & Stats</span></div></a>
          </div>
         <div class="conta3">
            <div class="t2"></div>
            <a href="index.php?page=deconnexion"><div class="dec"><span><img src="/assets/images/dec.svg" alt="" srcset=""></span><span>Déconnexion</span></div></a>
         </div>       
                   
        </div>
        <div  class="contb">
            <img class="s" src="/assets/images/search.svg" alt="" srcset="">
            <div class="contb1"><input type="text" name=""  placeholder="        Rechercher...." id="">
                <div class="c">
                    <div><img class="notif"  src="/assets/images/notif.svg" alt="" srcset=""></div>
                    <div class="c1">
                        <div class="ca">A</div>
                        <div class="c2">
                            <div>admin@sonatel-academy.sn</div>
                            <div>Administrateur</div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div  class="contb2">
                  <?=$contenu?>
            </div>
        </div>
    </div>
</body>
</html>