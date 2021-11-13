<template>
  <div class="wrapper">
    <CAlert :show.sync="showAlert" color="success" closeButton>
      {{ message }}
      <CButton
        class="position-absolute"
        color="secondary"
        style="right: 10px; top: 50%; transform: translateY(-50%)"
        @click="showAlert = false"
      >
        Close
      </CButton>
    </CAlert>
    <div>
      <CRow>
        <CCol>
          <CCard>
            <CCardHeader>
              <div class="d-flex justify-content-between">
                <h2>Jadwal</h2>
                <div class="d-flex align-items-end">
                  <div class="mr-2">
                    Divisi:
                    <CDropdown :toggler-text="selectedDivisi" color="primary">
                      <CDropdownItem
                        v-for="divisi in divisions"
                        :key="divisi"
                        @click="selectDivisi(divisi)"
                        >{{ divisi }}</CDropdownItem
                      >
                    </CDropdown>
                  </div>
                  <CButton
                    class="flex-0"
                    color="danger"
                    @click="isDelete = !isDelete"
                    >Hapus Pegawai</CButton
                  >
                </div>
              </div>
            </CCardHeader>
            <CCardBody>
              <table
                class="table table-bordered w-100"
                cellspacing="0"
                align="center"
                style="table-layout: fixed"
              >
                <thead>
                  <tr class="bg-light text-body">
                    <td align="center" height="50">
                      <b>Shift</b>
                    </td>
                    <td
                      v-for="hari in daftarHari"
                      :key="hari"
                      align="center"
                      height="50"
                    >
                      <b>{{ hari }}</b>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center" height="50"><b>07:00 - 14:59</b></td>
                    <IsiJadwal
                      v-for="hari in daftarHari"
                      :key="'isi-jadwal-' + hari"
                      :daftarPegawai="daftarJadwal[selectedDivisi][hari][0]"
                      @toggleModal="() => toggleModal(hari, 1)"
                      @deleteJadwal="deleteJadwal"
                      :isDelete="isDelete"
                    />
                  </tr>
                  <tr>
                    <td align="center" height="50"><b>15:00 - 22:59</b></td>
                    <IsiJadwal
                      v-for="hari in daftarHari"
                      :key="'isi-jadwal-' + hari"
                      :daftarPegawai="daftarJadwal[selectedDivisi][hari][1]"
                      @toggleModal="() => toggleModal(hari, 2)"
                      @deleteJadwal="deleteJadwal"
                      :isDelete="isDelete"
                    />
                  </tr>
                  <tr>
                    <td align="center" height="50"><b>23:00 - 6:59</b></td>
                    <IsiJadwal
                      v-for="hari in daftarHari"
                      :key="'isi-jadwal-' + hari"
                      :daftarPegawai="daftarJadwal[selectedDivisi][hari][2]"
                      @toggleModal="() => toggleModal(hari, 3)"
                      @deleteJadwal="deleteJadwal"
                      :isDelete="isDelete"
                    />
                  </tr>
                </tbody>
              </table>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <div>
      <CModal title="Tambah Pegawai" size="lg" :show.sync="modalTambah">
        <CCard>
          <CCardHeader><b>Daftar Pegawai</b></CCardHeader>
          <CListGroup flush>
            <CListGroupItem
              class="item-pegawai"
              v-for="pegawai in daftarPegawai"
              :key="pegawai.id"
              @click="addToPegawaiTerpilih(pegawai.id)"
            >
              <div class="d-flex justify-content-between">
                {{ pegawai.nama }}
                <CIcon name="cil-plus" />
              </div>
            </CListGroupItem>
            <CListGroupItem v-if="daftarPegawai.length == 0"
              >Tidak ada data</CListGroupItem
            >
          </CListGroup>
        </CCard>
        <CCard>
          <CCardHeader><b>Pegawai Terpilih</b></CCardHeader>
          <CListGroup flush>
            <CListGroupItem
              class="item-pegawai"
              v-for="pegawai in pegawaiTerpilih"
              :key="pegawai.id"
              @click="removeFromPegawaiTerpilih(pegawai.id)"
              >
                <div class="d-flex justify-content-between">
                  {{ pegawai.nama }}
                  <CIcon name="cil-trash" />
                </div>
              </CListGroupItem
            >
            <CListGroupItem v-if="pegawaiTerpilih.length == 0"
              >Tidak ada data</CListGroupItem
            >
          </CListGroup>
        </CCard>
        <template #footer>
          <CButton @click="modalTambah = false" color="danger">Batal</CButton>
          <CButton @click="tambahJadwal()" color="primary"
            >Tambah Jadwal</CButton
          >
        </template>
      </CModal>
    </div>
  </div>
</template>

<script>
import IsiJadwal from "./IsiJadwal";
import axios from "axios";

export default {
  name: "JadwalIndex",
  title: "Jadwal Pegawai",
  components: {
    IsiJadwal,
  },
  data() {
    return {
      selectedDivisi: "Keamanan",
      divisions: [
        "Kebersihan",
        "Keamanan",
        "Keserasian",
        "Kontrol",
        "Administrasi",
      ],
      daftarJadwal: {
        Keamanan: {
          Senin: [[], [], []],
          Selasa: [[], [], []],
          Rabu: [[], [], []],
          Kamis: [[], [], []],
          Jumat: [[], [], []],
          Sabtu: [[], [], []],
          Minggu: [[], [], []],
        },
        Kebersihan: {
          Senin: [[], [], []],
          Selasa: [[], [], []],
          Rabu: [[], [], []],
          Kamis: [[], [], []],
          Jumat: [[], [], []],
          Sabtu: [[], [], []],
          Minggu: [[], [], []],
        },
        Keserasian: {
          Senin: [[], [], []],
          Selasa: [[], [], []],
          Rabu: [[], [], []],
          Kamis: [[], [], []],
          Jumat: [[], [], []],
          Sabtu: [[], [], []],
          Minggu: [[], [], []],
        },
        Kontrol: {
          Senin: [[], [], []],
          Selasa: [[], [], []],
          Rabu: [[], [], []],
          Kamis: [[], [], []],
          Jumat: [[], [], []],
          Sabtu: [[], [], []],
          Minggu: [[], [], []],
        },
        Administrasi: {
          Senin: [[], [], []],
          Selasa: [[], [], []],
          Rabu: [[], [], []],
          Kamis: [[], [], []],
          Jumat: [[], [], []],
          Sabtu: [[], [], []],
          Minggu: [[], [], []],
        },
      },
      daftarHari: [
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
        "Minggu",
      ],
      modalTambah: false,
      daftarPegawai: [],
      pegawaiTerpilih: [],
      selectedHari: "",
      selectedShift: 0,
      isDelete: false,
      hapusModal: false,
      showAlert: false,
      message: "",
    };
  },
  methods: {
    convertData(data) {
      const converted = {
        Senin: [[], [], []],
        Selasa: [[], [], []],
        Rabu: [[], [], []],
        Kamis: [[], [], []],
        Jumat: [[], [], []],
        Sabtu: [[], [], []],
        Minggu: [[], [], []],
      };
      data.forEach((el) => {
        converted[el.hari][el.idShift - 1].push({
          id: el.id,
          nama: el.nama,
          idPegawai: el.idPegawai,
        });
      });
      return converted;
    },
    fetchJadwal() {
      axios
        .get(
          this.$apiAdress +
            "/api/jadwal?divisi=" +
            this.selectedDivisi +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.daftarJadwal[this.selectedDivisi] = this.convertData(r.data);
        });
    },
    fetchPegawai(ids) {
      axios
        .get(
          this.$apiAdress +
            "/api/pegawai?divisi=" +
            this.selectedDivisi +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.daftarPegawai = r.data.filter((data) => !ids.includes(data.id));
        });
    },
    getPegawaiByHari(hari) {
      return [].concat.apply([], this.daftarJadwal[this.selectedDivisi][hari]);
    },
    toggleModal(hari, shift) {
      this.modalTambah = !this.modalTambah;
      this.pegawaiTerpilih = [];
      this.selectedHari = hari;
      this.selectedShift = shift;
      const ids = this.getPegawaiByHari(hari).map((p) => p.idPegawai);
      this.fetchPegawai(ids);
    },
    addToPegawaiTerpilih(id) {
      const index = this.daftarPegawai.findIndex((pegawai) => pegawai.id == id);
      this.pegawaiTerpilih.push(this.daftarPegawai[index]);
      this.daftarPegawai = this.daftarPegawai.filter(
        (pegawai) => pegawai.id != id
      );
    },
    removeFromPegawaiTerpilih(id) {
      const index = this.pegawaiTerpilih.findIndex((pegawai) => pegawai.id == id);
      this.daftarPegawai.push(this.pegawaiTerpilih[index]);
      this.pegawaiTerpilih = this.pegawaiTerpilih.filter(
        (pegawai) => pegawai.id != id
      );
    },
    tambahJadwal() {
      this.pegawaiTerpilih.forEach((pegawai) => {
        const formData = new FormData();
        formData.append("hari", this.selectedHari);
        formData.append("idPegawai", pegawai.id);
        formData.append("idShift", this.selectedShift);
        axios
          .post(
            this.$apiAdress +
              "/api/jadwal?token=" +
              localStorage.getItem("api_token"),
            formData
          )
          .then((r) => {
            this.message = r.data.message;
          });
      });
      this.showAlert = true;
      this.modalTambah = false;
      this.fetchJadwal();
    },
    selectDivisi(divisi) {
      this.selectedDivisi = divisi;
      this.fetchJadwal();
    },
    deleteJadwal(message) {
      this.fetchJadwal();
      this.message = message;
      this.showAlert = true;
    }
  },
  mounted() {
    this.fetchJadwal();
  },
};
</script>

<style scoped>
.item-pegawai:hover {
  color: white;
  background-color: rgb(82, 82, 94);
  cursor: pointer;
}
</style>
