<template>
    <div class="wrap">
        <h1>Impressum</h1>
        <h3>Angaben gemäß § 5 TMG</h3>
        <p>HONORAR.online<br>
            c/o <a href="http://faar.studio/">FAAR.studio</a><br>
            Viktor Filimonow Dipl. Ing. (FH) Architekt<br>
            Plinganserstraße 150<br>
            81369 München, Deutschland<br>
        </p>
        <h3>Vertreten durch:</h3>
        <p>Viktor Filimonow</p>
        <h3>Kontakt:</h3>
        <p>Telefon: 0049 176 10505505<br>
            E-Mail: mail @ honorar.online<br>
        </p>
        <h3>Berufsbezeichnung:</h3>
        <p>Architekt (verliehen in der Bundesrepublik Deutschland)</p>
        <h3>Zuständige Kammer:</h3>
        <p>Bayerische Architektenkammer<br>
            Waisenhausstraße 4<br>
            80637 München<br>
            Web: <a href="https://www.byak.de">https://www.byak.de</a> 
        </p>
        <h3>Berufsrechtliche Regelungen:</h3>
        <ul>
            <li>Baukammerngesetz (BauKaG)</li>
            <li>Berufsordnung der Bayerischen Architektenkammer<br>
                Die berufsrechtlichen Regelungen können über die Website der Bayerischen Architektenkammer eingesehen 
                werden:  <a href="https://www.byak.de">https://www.byak.de</a>  </li>
        </ul>
        <h3>Umsatzsteuer-ID</h3>
        <p>Umsatzsteuer-Identifikationsnummer gemäß §27a Umsatzsteuergesetz: DE224858745</p> 
    </div> 
</template>

<script>
export default {
    name: 'Impressum',
    data(){
        return{

        }
    }
}

</script>
    
<style scoped>
    .wrap{
        font-family: 'Raleway-Regular';

    }
    h1{
        text-align: center;
        font-family: 'Raleway-Light';
        font-size: 36px;
        margin-bottom: 30px;
    }
    h3{
        font-size: 20px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    p, li {
        padding-left: 30px;
        font-size: 18px;
        color: #636363;
    }

</style>