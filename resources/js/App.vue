<template>
  <div class="container">
    <h1 style="margin-top: 5%; margin-bottom: 5%" class="text-center">
      To do / Notes system
    </h1>
    <div>
      <div class="row" style="min-height: 70vh">
        <div class="col-xs-6 col-sm-4">
          <form
            v-if="toUpdate.id"
            method="post"
            action=""
            @submit.prevent="updateTask"
          >
            <textarea
              id="description"
              style="line-height: 28px; background-color: white"
              maxlength="255"
              class="form-control"
              placeholder="Task description"
              v-model="toUpdate.description"
              required
              cols="2"
              rows="3"
            ></textarea>

            <button
              :disabled="submitting"
              class="btn btn-success"
              type="submit"
              style="width: 50%; margin-top: 20px"
            >
              Submit
            </button>

            <a
              class="btn btn-danger"
              style="width: 50%; margin-top: 20px"
              @click="
                (this.toUpdate.id = null), (this.toUpdate.description = null)
              "
              >Cancel</a
            >
          </form>

          <form
            v-if="!toUpdate.id"
            name="Form"
            method="post"
            @submit.prevent="createNewTask"
          >
            <textarea
              name="description"
              class="form-control"
              placeholder="Insert task name"
              style="background-color: white; line-height: 28px"
              v-model="description"
              required
              maxlength="255"
              cols="2"
              rows="3"
            ></textarea>

            <button
              :disabled="submitting"
              class="btn btn-primary"
              type="submit"
              style="width: 100%; margin-top: 20px"
            >
              Add
            </button>
          </form>
        </div>
        <div class="col-xs-6 col-sm-8">
          <div
            style="
              border: 1px solid #ddd;
              border-radius: 5px;
              padding: 20px;
              margin-bottom: 150px;
              background-color: white;
            "
          >
            <table class="table align-middle text-left table-responsive">
              <thead>
                <tr>
                  <th class="col-md">#</th>
                  <th class="col-md">Task</th>
                  <th class="col-md"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(todo, index) in todos" :key="todo.id">
                  <th class="col-md-1">{{ index + 1 }}</th>

                  <td
                    v-if="todo.completed === 1"
                    class="col-md-9"
                    style="
                      text-decoration: line-through;
                      overflow-wrap: break-word;
                    "
                  >
                    {{ todo.description }}
                  </td>

                  <td v-else style="overflow-wrap: break-word">
                    {{ todo.description }}
                  </td>
                  <td class="col-md-2">
                    <a
                      v-if="todo.completed === 0"
                      title="Complete the task"
                      @click="completeTask(todo.id)"
                      class="m-1 btn btn-sm btn-success"
                      ><i class="bi bi-check-lg"></i
                    ></a>
                    <a
                      v-if="todo.completed === 0"
                      @click="
                        (this.toUpdate.id = todo.id),
                          (this.toUpdate.description = todo.description)
                      "
                      title="Edit the task"
                      class="m-1 btn btn-sm btn btn-primary"
                      ><i class="bi bi-pen"></i
                    ></a>
                    <a
                      @click="removeTask(todo.id)"
                      title="Remove the task"
                      class="m-1 btn btn-sm btn btn-danger"
                      ><i class="bi bi-x-lg"></i
                    ></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="col-xl-12">
        <div class="copyright text-center">
          Copyrigh &copy; 2022 All Rights Reserved.
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "partnersPipelines",
  components: {},

  data() {
    return {
      toUpdate: [
        {
          id: null,
          description: null,
        },
      ],
      todos: null,
      selectedPartnerName: null,
      description: null,
      submitting: false,
    };
  },

  methods: {
    updateTask() {
      this.submitting = true;
      axios
        .post("/update", {
          id: this.toUpdate.id,
          description: this.toUpdate.description,
        })
        .then((res) => {
          axios.get("/todos").then((response) => {
            this.todos = response.data;
            this.toUpdate.id = null;
            this.toUpdate.description = null;
            this.submitting = false;
          });
        })
        .catch((error) => {
          this.error = error;
        });
    },

    createNewTask() {
      this.submitting = true;
      axios
        .post("/create", {
          description: this.description,
        })
        .then((res) => {
          axios.get("/todos").then((response) => {
            this.todos = response.data;
            this.description = null;
            this.submitting = false;
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    completeTask(id) {
      axios
        .get("/complete/" + id)
        .then((res) => {
          axios.get("/todos").then((response) => {
            this.todos = response.data;
            this.toUpdate.id = null;
            this.toUpdate.description = null;
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeTask(id) {
      axios
        .get("/delete/" + id)
        .then((res) => {
          axios.get("/todos").then((response) => {
            this.todos = response.data;
            this.toUpdate.id = null;
            this.toUpdate.description = null;
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {
    axios
      .get("/todos")
      .then((response) => {
        this.todos = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
