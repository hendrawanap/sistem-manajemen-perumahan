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
            <CButton type="submit" color="primary" @click="editPegawai()">
                Submit
            </CButton>
        </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
    name: "PegawaiEdit",
    title: 'Edit Pegawai',
    data() {
      return {
        biodata: {
          nama: "",
          gender: null,
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
        jabatanOptions: [
          "Kepala",
          "Wakil Kepala",
          "Anggota"
        ],
        divisiOptions: [
          'Kebersihan',
          'Keamanan',
          'Keserasian',
          'Kontrol',
          'Administrasi'
        ],
      }
    },
    methods: {
      editPegawai(){
        axios.put(this.$apiAdress + '/api/pegawai/' + this.$route.params.id + '?token=' + localStorage.getItem('api_token'), this.biodata).then(r => {
          this.$router.push('/pegawai?message=' + r.data.message);
        })
      },
      getPegawai() {
        axios.get(this.$apiAdress + '/api/pegawai/' + this.$route.params.id + '?token=' + localStorage.getItem('api_token')).then( r => {
          const data = r.data;
          this.biodata = {
            nama: data.nama,
            gender: data.gender,
            alamat: data.alamat,
            tanggalMasuk: data.tanggalMasuk,
            divisi: data.divisi,
            jabatan: data.jabatan,
          }
        });
      }
    },
    mounted() {
      this.getPegawai();
    }
}
</script>