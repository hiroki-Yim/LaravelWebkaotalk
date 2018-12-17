<template>
  <ul class="chat">
    <li class="left clearfix" v-for="message in messages">
      <div class="chat-body clearfix">
        <div class="header">
          <strong class="primary-font">{{ message.user.nickname }}</strong>
        </div>
        <p>{{ message.message }}</p>
        <p style="flex:left;">{{ message.created_at}}</p>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["messages"]
};
</script>