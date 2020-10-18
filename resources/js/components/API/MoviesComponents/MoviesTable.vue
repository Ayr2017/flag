<template>
  <v-card flat tile>
    <v-toolbar dense flat color="blue-grey lighten-3">
      <template v-if="$vuetify.breakpoint.mdAndUp">
        <v-divider vertical></v-divider>

        <v-overflow-btn
          :items="['dropdown_edit']"
          editable
          label="Жанры"
          hide-details
          class="ma-1"
          overflow
          height="48"
        ></v-overflow-btn>

        <div class="mx-4"></div>

        <v-btn-toggle v-model="toggle_exclusive" color="primary" dense group>
          <v-btn :value="0" text>
            <v-icon>mdi-arrow-up-bold</v-icon>Сначала новые
          </v-btn>

          <v-btn :value="1" text>
            <v-icon>mdi-arrow-down-bold</v-icon>Сначала старые
          </v-btn>
        </v-btn-toggle>
      </template>
    </v-toolbar>

    <v-container class="grey lighten-4" fluid>
      <v-subheader>{{ 'type' }}</v-subheader>

      <v-row>
        <v-spacer></v-spacer>
        <v-col cols="12" sm="12" md="12" lg="12">
          <v-list three-line>
            <template v-for="(item, index) in items">
              <v-subheader
                v-if="item.header"
                :key="item.header"
                v-text="item.header"
              ></v-subheader>

              <v-divider
                v-else-if="item.divider"
                :key="index"
                :inset="item.inset"
              ></v-divider>

              <v-list-item v-else :key="item.title">
                <v-list-item-avatar tile size="80" color="grey">
                  <v-img :src="item.avatar"></v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                  <v-list-item-title v-html="item.title"></v-list-item-title>
                  <v-list-item-subtitle
                    v-html="item.subtitle"
                  ></v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </template>
          </v-list>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          ><template>
            <div class="text-center">
              <!-- <v-pagination v-model="page" :length="6"></v-pagination> -->
            </div>
          </template>
        </v-col>
      </v-row> </v-container
  ></v-card>
</template>


    <script>
export default {
  data: () => ({
    toggle_exclusive: 0,
    items: [
      { header: "Today" },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
        title: "Brunch this weekend?",
        subtitle:
          "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
        title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
        subtitle:
          "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.",
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
        title: "Oui oui",
        subtitle:
          "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?",
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
        title: "Birthday gift",
        subtitle:
          "<span class='text--primary'>Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?",
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/5.jpg",
        title: "Recipe to try",
        subtitle:
          "<span class='text--primary'>Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.",
      },
    ],
  }),

  methods: {
    getImage() {
      const min = 550;
      const max = 560;

      return Math.floor(Math.random() * (max - min + 1)) + min;
    },
  },
};
</script>

