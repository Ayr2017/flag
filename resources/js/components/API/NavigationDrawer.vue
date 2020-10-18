<template>
  <v-list nav dense rounded>
    <v-list-item-group
      v-model="group"
      active-class="deep-purple--text text--accent-4"
    >
      <v-list-item  link to="/">
        <v-list-item-title>Показать</v-list-item-title>
      </v-list-item>

      <v-list-item link to="/create">
        <v-list-item-title>Создать новый</v-list-item-title>
      </v-list-item>

      <v-list-item link to="/edit">
        <v-list-item-title>Редактировать</v-list-item-title>
      </v-list-item>

      <v-list-item link to="/delete">
        <v-list-item-title>Удалить</v-list-item-title>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
    data:()=>({
        group: null
    })
};
</script>