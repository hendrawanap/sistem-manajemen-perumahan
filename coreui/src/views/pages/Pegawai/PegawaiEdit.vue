<template>
    <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
        <div class="d-flex justify-content-between">
              <h2>Edit Pegawai</h2>
        </div>
        </CCardHeader>
        <CCardBody>
        <CForm v-on:submit.prevent>
            <CInput label="Nama Pegawai" type="text" id="inputNama" v-model="biodata.nama"/>
            <CSelect
              label="Gender"
              :options="genderOptions"
              :value.sync="biodata.gender"
              placeholder="Pilih Gender"
            />
            <CInput label="Email" type="email" id="inputEmail" aria-describedby="emailHelp" v-model="biodata.email" />
            <CInput label="Alamat"  type="text" id="inputPassword" v-model="biodata.alamat" />
            <CInput label="Tanggal Masuk"  type="date" id="inputTanggal" v-model="biodata.tanggalMasuk" />
             <CSelect
              label="Divisi"
              :options="divisiOptions"
              :value.sync="biodata.divisi"
              placeholder="Pilih Divisi"
            />
            <CSelect
              label="Jabatan"
              :options="jabatanOptions"
              :value.sync="biodata.jabatan"
              placeholder="Pilih Jabatan"
            />
            <CButton type="submit" color="primary" @click="submit()">
                Submit
            </CButton>
        </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
export default {
    name: "PegawaiTambah",
    data() {
      return {
        biodata: {
          nama: "",
          gender: null,
          email: "",
          alamat: "",
          tanggalMasuk: null,
          divisi: "",
          jabatan: "",
        },
        genderOptions: [
          {
            value: 0,
            label: "Laki-laki"
          },
          {
            value: 1,
            label: "Perempuan"
          },
        ],
      }
    },
    methods: {
      submit() {
        console.log(this.biodata) 
      }
    }
}
</script>