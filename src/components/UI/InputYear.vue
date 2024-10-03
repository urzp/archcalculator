<template>
    <input ref="thisinput" type="text"  maxlength="4" 
    @input="event =>validate(event)" 
    @change="event => submit_event(event)">
</template>

<script>
export default{
    name: 'InputYear',
    props:{
        focus:Boolean,
    },
    emits:['submit_event'],
    watch:{
        focus(n_val, o_val){
            if(n_val){
                setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
            }
        }
    },
    methods:{
        validate(event){
            let val = event.target.value
            let position = event.target.selectionStart - 1
            if(/[^0-9]/g.test(val)){
                event.target.value = val.toString().replace(/[^0-9]/g, '');
                event.target.setSelectionRange(position, position)
            }
        },
        submit_event(event){
            let val = event.target.value
            this.$refs.thisinput.value = ''
            this.$emit('submit_event', val)
        }
    }
}
</script>

<style scoped>
    input{
        height: 45px;
        width: 150px;
        border-radius: 5px;
        background-color: #ebebeb;
        text-align: center;
        font-size: 20px;
        font-family: 'Raleway-Light';
        color: #464646;
    }
</style>