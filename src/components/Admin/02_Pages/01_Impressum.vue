<template>
    <div class="wrap_admin_editpage">
        <div class="main-title">
            <div class="title">Edit Page: Impressum</div>
        </div>
        <div class="content">
            <QuillEditor theme="snow" ref="qEditor" toolbar="essential" @ready="init()" />
        </div>
        <Button width="150px" @click="save()">Save</Button>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'EditPagesImpressum',
    methods:{
        async init(){
            let content = `<h1>Impressum</h1><h3>Angaben gemäß § 5 TMG</h3><p>HONORAR.online</p><p>c/o&nbsp;<a href="http://faar.studio/" rel="noopener noreferrer" target="_blank" style="color: rgb(235, 170, 108);">FAAR.studio</a></p><p>Viktor Peters Dipl. Ing. (FH) Architekt</p><p>Plinganserstraße 150</p><p>81369 München, Deutschland</p><h3>Vertreten durch:</h3><p>Viktor Peters</p><p><br></p><h3>Kontakt:</h3><p>Telefon: 0049 176 10505505</p><p>E-Mail: mail @ honorar.online</p><p><br></p><h3>Berufsbezeichnung:</h3><p>Architekt (verliehen in der Bundesrepublik Deutschland)</p><p><br></p><h3>Zuständige Kammer:</h3><p>Bayerische Architektenkammer</p><p>Waisenhausstraße 4</p><p>80637 München</p><p>Web:&nbsp;<a href="https://www.byak.de/" rel="noopener noreferrer" target="_blank" style="color: rgb(235, 170, 108);">https://www.byak.de</a></p><h3>Berufsrechtliche Regelungen:</h3><ul><li>Baukammerngesetz (BauKaG)</li><li>Berufsordnung der Bayerischen Architektenkammer</li><li>Die berufsrechtlichen Regelungen können über die Website der Bayerischen Architektenkammer eingesehen werden:&nbsp;<a href="https://www.byak.de/" rel="noopener noreferrer" target="_blank" style="color: rgb(235, 170, 108);">https://www.byak.de</a></li></ul><h3>Umsatzsteuer-ID</h3><p>Umsatzsteuer-Identifikationsnummer gemäß §27a Umsatzsteuergesetz: DE224858745</p>`
            let data = await apiData({typeData:'adminPagesInfRead', name:'impressum'})
            if(data.success){
                this.$refs.qEditor.setHTML(data.data['content'])
            }
        },
        async save(){
            let content = this.$refs.qEditor.getHTML()
            console.log(content)
            await apiData({typeData:'adminPagesInfUpdate', name:'impressum', content})
        },
    }
}
</script>

<style scoped>
    .wrap_admin_editpage{
        min-height: 75vh;
        margin-bottom: 50px;
    }

    .title{
        margin-top: 60px;
        text-align: center;
        font-size: 36px;
        font-family: 'Raleway-Light';
        color: #2c3e50;
    }

    .content{
        margin-bottom: 20px;
    }

</style>