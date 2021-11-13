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
        <CForm @submit="tambahPegawai">
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
    name: "PegawaiTambah",
    title:'Tambah Pegawai',
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
      tambahPegawai(e){
        const formData = new FormData()
        const biodata = this.biodata
        formData.append("nama", biodata.nama);
        formData.append("gender", biodata.gender);
        formData.append("alamat", biodata.alamat);
        formData.append("tanggalMasuk", biodata.tanggalMasuk);
        formData.append("divisi", biodata.divisi);
        formData.append("jabatan", biodata.jabatan);
        e.preventDefault();
        axios.post(this.$apiAdress + '/api/pegawai?token=' + localStorage.getItem('api_token'), formData).then(r => {
          this.$router.push('/pegawai?message=' + r.data.message);
        })
      },
    }
}
</script>