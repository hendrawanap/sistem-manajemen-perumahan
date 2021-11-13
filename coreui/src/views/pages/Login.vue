<template>
  <CContainer class="d-flex content-center min-vh-100">
    <CRow>
      <CCol>
        <CCardGroup>
          <CCard class="p-4">
            <CCardHeader>
              <img
                v-bind:src="require('../../assets/' + img)"
                size="custom-size"
                :height="150"
              />
            </CCardHeader>
            <CCardBody>
              <CForm @submit.prevent="login" method="POST">
                <h1>Login</h1>
                <p class="text-muted">Masuk ke akunmu</p>
                <CInput
                  v-model="email"
                  prependHtml="<i class='cui-user'></i>"
                  placeholder="Username"
                  autocomplete="username email"
                >
                  <template #prepend-content
                    ><CIcon name="cil-user"
                  /></template>
                </CInput>
                <CInput
                  v-model="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  placeholder="Password"
                  type="password"
                  autocomplete="curent-password"
                >
                  <template #prepend-content
                    ><CIcon name="cil-lock-locked"
                  /></template>
                </CInput>
                <CRow>
                  <CCol col="12">
                    <CButton type="submit" color="primary" class="px-4"
                      >Login</CButton
                    >
                  </CCol>
                </CRow>
                <!-- <CRow
                  ><CCol col="12" class="text-mid">
                    <CButton color="link" class="px-0"
                      >Lupa Kata Sandi?</CButton
                    >
                  </CCol>
                </CRow> -->
                <!-- <CRow>
                  <CCol col="12" class="text-mid">Tidak memiliki account?</CCol>
                </CRow>
                <CRow
                  ><CCol>
                    <CButton
                      color="primary"
                      class="active mt-3"
                      @click="goRegister()"
                    >
                      Daftar Sekarang!
                    </CButton>
                  </CCol></CRow
                > -->
              </CForm>
            </CCardBody>
          </CCard>
        </CCardGroup>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      img: "logo.png",
      email: "",
      password: "",
      showMessage: false,
      message: "",
    };
  },
  methods: {
    goRegister() {
      this.$router.push({ path: "register" });
    },
    login() {
      let self = this;
      axios
        .post(this.$apiAdress + "/api/login", {
          email: self.email,
          password: self.password,
        })
        .then(function (response) {
          self.email = "";
          self.password = "";
          localStorage.setItem("api_token", response.data.access_token);
          localStorage.setItem("roles", response.data.roles);
          self.$router.push({ path: "dashboard" });
        })
        .catch(function (error) {
          self.message = "Incorrect E-mail or password";
          self.showMessage = true;
          console.log(error);
        });
    },
  },
};
</script>
