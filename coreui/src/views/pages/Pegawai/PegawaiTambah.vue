<template>
    <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
        <div class="d-flex justify-content-between">
              <h2>Tambah Pegawai</h2>
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
            <CButton type="submit" color="primary" @click="tambahPegawai()">
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
    name: "PegawaiTambah",
    title:'Tambah Pegawai',
    data() {
      return {
        biodata: {
          nama: "",
          gender: null,
          alamat: "",
          tanggalMasuk: null,
          divisi: "keamanan",
          jabatan: "kepala",
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
      tambahPegawai(){
        const formData = new FormData()
        const biodata = this.biodata
        formData.append("nama", biodata.nama);
        formData.append("gender", biodata.gender);
        formData.append("alamat", biodata.alamat);
        formData.append("tanggalMasuk", biodata.tanggalMasuk);
        formData.append("divisi", biodata.divisi);
        formData.append("jabatan", biodata.jabatan);

        axios.post(this.$apiAdress + '/api/pegawai?token=' + localStorage.getItem('api_token'), formData).then(r => {
          this.$router.push('/pegawai?message=' + r.data.message);
        })
      },
    }
}
</script>