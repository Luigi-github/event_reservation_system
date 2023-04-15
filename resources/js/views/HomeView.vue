<script>
export default {
    mounted() {
        const token = localStorage.getItem('token');
        if(!!token){
            this.$router.push('event');
        }else{
            this.$router.push('login');
        }
    }
}
</script>
