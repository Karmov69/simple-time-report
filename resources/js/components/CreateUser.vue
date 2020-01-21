<template>
  <div>
    <div class="form-group">
      <div class="col-md-9">
        <label for="role">Роль</label>
        <select
          name="role"
          id="role"
          class="form-control"
          v-if="action_type === 'edit'"
          v-model="selectRole"
          :disabled="auth_user === user_id"
        >
          <option
            :value="role.name"
            v-for="(role, index) in roleList"
            :key="index"
            :selected="role.name === currentRole"
          >{{role.name}}</option>
        </select>
        <input v-if="auth_user === user_id" type="hidden" v-model="selectRole" name="role">
        <select name="role" v-if="action_type === 'create'" id="role" class="form-control" v-model="selectRole">
          <option :value="role.name" v-for="(role, index) in roleList" :key="index">{{role.name}}</option>
        </select>
      </div>
    </div>

    <div class="form-group" v-show="selectRole!=='admin'">
      <div class="col-md-9">
        <label for="plane_hours">Плановое рабочее время</label>
        <input
          v-if="action_type === 'edit'"
          type="number"
          :value="planeHours"
          name="plane_hours"
          id="plane_hours"
          class="form-control"
          required
        >
        <input
          v-else
          type="number"
          value="40"
          name="plane_hours"
          id="plane_hours"
          class="form-control"
          required
        >
      </div>
    </div>

    <div class="form-group" v-show="selectRole!=='admin'">
      <div class="col-md-9">
        <label for="week_hours">Рабочие часы</label>
        <input
          v-if="action_type === 'edit'"
          type="number"
          name="week_hours"
          id="week_hours"
          :value="weekHours"
          class="form-control"
          required
        >
        <input
          v-else
          type="number"
          name="week_hours"
          id="week_hours"
          value="35"
          class="form-control"
          required
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "roles_list",
    "current_role",
    "action_type",
    "plane_hours",
    "week_hours",
    "auth_user",
    "user_id",
  ],
  data() {
    return {
      selectRole: this.current_role || "user",
      roleList: this.roles_list,
      currentRole: this.current_role,
      planeHours: this.plane_hours,
      weekHours: this.week_hours
    };
  },
  watch: {
    selectRole(newVal, oldVal) {
      if (newVal === "admin") {
        this.planeHours = 0;
        this.weekHours = 0;
      }
    }
  }
};
</script>
