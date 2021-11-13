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
        <CForm @submit="editPegawai">
            <CInput
              label="Nama Pegawai"
              type="text"
              v-model="biodata.nama"
              invalid-feedback="Nama pegawai tidak boleh kosong."
              :is-valid="biodata.nama.length > 0"
              required
            />
            <CSelect
              label="Gender"
              :options="genderOptions"
              :value.sync="biodata.gender"
              placeholder="Pilih Gender"
              invalid-feedback="Gender tidak boleh kosong."
              :is-valid="biodata.gender != null"
              required
            />
            <CInput
              label="Alamat"
              type="text"
              v-model="biodata.alamat"
              invalid-feedback="Alamat tidak boleh kosong."
              :is-valid="biodata.alamat.length > 0"
              required
            />
            <CInput
              label="Tanggal Masuk"
              type="date"
              v-model="biodata.tanggalMasuk"
              invalid-feedback="Tanggal masuk tidak boleh kosong."
              :is-valid="biodata.tanggalMasuk != null"
              required
            />
             <CSelect
              label="Divisi"
              :options="divisiOptions"
              :value.sync="biodata.divisi"
              placeholder="Pilih Divisi"
              invalid-feedback="Divisi tidak boleh kosong."
              :is-valid="biodata.divisi != null"
              required
            />
            <CSelect
              label="Jabatan"
              :options="jabatanOptions"
              :value.sync="biodata.jabatan"
              placeholder="Pilih Jabatan"
              invalid-feedback="Jabatan tidak boleh kosong."
              :is-valid="biodata.jabatan != null"
              required
            />
            <CButton type="submit" color="primary">
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
          divisi: null,
          jabatan: null,
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
      editPegawai(e){
        e.preventDefault();
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