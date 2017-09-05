<template>
  <div id="related_posts">
    <div class="form-group">
        <div class="col-md-9">

            <input type="hidden" name="related_posts" v-model="related_posts_input" />

            <div>
                <ul>
                    <li v-for='p in related_posts' @click="removePost(p)">{{ p.title }}</li>
                </ul>
            </div>

            <label class="control-label">related posts: </label>
            <input type="text" id="input_post" class="form-control" v-model="post" v-on:keyup="getPosts">

            <ul id="posts">
                <li v-for='p in posts' @click="addPost(p)"> {{ p.title }}</li>
            </ul>

        </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      post: '',
      related_posts: [],
      related_posts_input : '',
      posts: []
    }
  },
  methods: {
      getPosts(){
          if(this.post)
          this.$http.get('/blog/get_posts/'+this.post+'?limit=10').then((response) => {
              this.posts = response.body;;
          });
          else 
            this.posts = [];
      },
      addPost(post){
          this.posts.splice(this.posts.indexOf(post), 1);
          this.related_posts.push(post);
          this.related_posts_input += post.id+";";
      },
      removePost(post){
          this.related_posts.splice(this.posts.indexOf(post), 1);
          this.posts.push(post);

          a.map(function(i){
            while(a.indexOf(i) != a.lastIndexOf(i)){
                a.splice(a.lastIndexOf(i), 1);
            }
          });

          this.posts.sort(function(p1, p2){
              return p1.title < p1.title;
          });
          this.related_posts_input = this.related_posts_input.replace(post.id+";", "");
          console.log(this.related_posts_input);
      }

  }
}
</script>

<style>

#related_posts ul{
    padding: 0px;
}

#related_posts li {
    list-style: none;
}

#related_posts li:hover {
    background: red;
}

</style>

