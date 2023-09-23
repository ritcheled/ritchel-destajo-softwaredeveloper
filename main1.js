
const app = Vue.createApp({
    data() {
       return{
        videos: [],
        channel:[],
        tnail:{},
        index: 0,
        active_pg: 1
        

       } 
    },
    methods: {
        get_pg(pg_num){
            let fname;
            this.active_pg = pg_num;
            if (this.active_pg < 1)
            {
                this.active_pg = 1;
            }
            if (this.active_pg > 5)
            {
                this.active_pg = 5;
            }
           // fetch('https://jsonplaceholder.typicode.com/posts')
            if ( this.active_pg == 1){
                fname = './v0.json';
            }
            else if (this.active_pg == 2){
                fname = './v1.json';
            }
            else if (this.active_pg == 3){
                fname = './v2.json';
            }
            else if (this.active_pg == 4){
                fname = './v3.json';
            }
            else{
                fname = './v4.json';
            }    
            fetch(fname)
                .then(response => response.json())
                .then(data => 
                    {
                        this.videos = data
                    })
        },

        get_channel(){
            fetch('./channel.json')
                .then(response => response.json())
                .then(data => 
                    {
                        this.channel = data.items[0].snippet;
                        this.tnail = data.items[0].snippet.thumbnails.default;
                    })
            this.get_pg(this.active_pg);        
        },

      mount(){
            this.get_channel();
        },
        
        getYTUrl(videoId) {
              return `https://www.youtube.com/watch?v=${videoId}`;
            }
    }
})

