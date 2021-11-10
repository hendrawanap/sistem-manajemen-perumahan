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
        const formData = new FormData()
        const biodata = this.biodata
        formData.append("nama", biodata.nama);
        formData.append("gender", biodata.gender);
        formData.append("alamat", biodata.alamat);
        formData.append("tanggalMasuk", biodata.tanggalMasuk);
        formData.append("divisi", biodata.divisi);
        formData.append("jabatan", biodata.jabatan);

        axios.post(this.$apiAdress + '/api/pegawai/edit/' + this.$route.params.id, formData).then( r => console.log('berhasil diubah'))
      },
      getPegawai() {
        axios.get(this.$apiAdress + '/api/pegawai/' + this.$route.params.id).then( r => {
          const data = r.data[0];
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