<template>
  <v-card :loading="loading" class="mx-auto my-12" max-width="500">
    <v-card-subtitle>Редактирование</v-card-subtitle>
    <v-card-text>
      <form>
        <v-text-field
          outlined
          v-model="id"
          :counter="100"
          label="ID"
          disabled
        ></v-text-field>
        <v-text-field
          outlined
          v-model="name"
          :counter="100"
          label="Название фильма"
          required
        ></v-text-field>
        <v-textarea
          outlined
          :auto-grow="true"
          rows="2"
          name="input-7-4"
          label="Описание фильма"
          v-model="description"
          :counter="500"
        ></v-textarea>
        <v-file-input
          v-model="img"
          outlined
          accept="image/*"
          label="Изображение"
        ></v-file-input>
        <v-container v-show="imgURL && !img" class="grey lighten-2 pa-2 ma-1 mb-5">
          <v-img max-height="100" max-width="100" :src="imgURL"></v-img>
        </v-container>
        <v-menu
          ref="menu"
          v-model="menu"
          :close-on-content-click="false"
          :return-value.sync="released_at"
          transition="scale-transition"
          offset-y
          min-width="290px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              outlined
              v-model="released_at"
              label="Дата выпуска"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker v-model="released_at" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="menu = false"> Cancel </v-btn>
            <v-btn text color="primary" @click="$refs.menu.save(released_at)">
              OK
            </v-btn>
          </v-date-picker>
        </v-menu>

        <v-select
          v-model="genres"
          :items="allGenres"
          label="Жанры"
          multiple
          chips
          hint="Можно выбрать несколько"
          persistent-hint
        ></v-select>

        <v-btn text class="mr-4" @click="submit"> Сохранить изменения </v-btn>
        <v-btn text @click="clear"> Очистить </v-btn>
      </form>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from "axios";
export default {
  name: "Edit",
  data: () => ({
    id: "",
    name: "",
    description: "",
    released_at: "2020-01-01",
    menu: null,
    img: null,
    imgURL: "",
    genres: [],
    allGenres: [],
    loading: false,
  }),
  methods: {
    submit() {
      let formData = new FormData();
      formData.append("id", this.id);
      formData.append("name", this.name);
      formData.append("description", this.description);
      formData.append("released_at", this.released_at);
      formData.append("genres", JSON.stringify(this.genres));
      formData.append("img", this.img);
      formData.append("_method", "PATCH");
      this.loading = true;
      axios
        .post("api/movies", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => console.log(response))
        .catch((error) => console.log(error))
        .finally((this.loading = false));
    },
    getAllGenres() {
      axios.get("/api/genres/").then((response) => {
        console.log(response.data);
        this.allGenres = response.data;
      });
    },
    getMovieById(id) {
      axios.get(`/api/movies/${id}`).then((response) => {
        let data = response.data;
        this.id = data.id;
        this.name = data.name;
        this.description = data.description;
        this.released_at = data.released_at;
        this.imgURL = data.files.publicURL;
        this.genres = data.genres.map(function (element) {
          return element.id;
        });
      });
    },
    clear() {},
  },

  created() {
    this.getAllGenres();
  },
  mounted() {
    this.getMovieById(1);
  },
};
</script>