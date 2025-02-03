<template>
  <div class="main-board-mealxpress">
    <NavbarComponent />
    <div class="mealxpress-content">
      <HeaderDashboard />
      <div class="mealxpress-main">
        <div>
          <!-- Search Input -->
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search..."
            class="search-input"
          />

          <!-- Select Rows per Page -->
          <select v-model="rowsPerPage" @change="changeRowsPerPage" class="rows-select">
            <option v-for="option in rowsOptions" :key="option" :value="option">
              {{ option }}
            </option>
          </select>

          <!-- Data Table -->
          <table class="data-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Country</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in paginatedData" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.age }}</td>
                <td>{{ item.country }}</td>
              </tr>
            </tbody>
          </table>

          <!-- Pagination Controls -->
          <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
            <span>Page {{ currentPage }} of {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import NavbarComponent from './../../components/vendorsnav/aside.vue';
import HeaderDashboard from './../../components/vendorsnav/header.vue';

export default {
  components: {
    NavbarComponent,
    HeaderDashboard,
  },
  setup() {
    const data = ref([
      { id: 1, name: 'Alice', age: 25, country: 'USA' },
      { id: 2, name: 'Bob', age: 30, country: 'Canada' },
      { id: 3, name: 'Charlie', age: 35, country: 'UK' },
      { id: 4, name: 'Alice', age: 25, country: 'USA' },
      { id: 5, name: 'Bob', age: 30, country: 'Canada' },
     
      // Add more data as needed
    ]);

    const searchQuery = ref('');
    const rowsPerPage = ref(3); // Default rows per page
    const rowsOptions = [3, 20, 50, 100]; // Rows per page options
    const currentPage = ref(1);

    const filteredData = computed(() => {
      if (!searchQuery.value) return data.value;

      return data.value.filter((item) =>
        Object.values(item).some((val) =>
          String(val).toLowerCase().includes(searchQuery.value.toLowerCase())
        )
      );
    });

    const totalPages = computed(() => {
      return Math.ceil(filteredData.value.length / rowsPerPage.value);
    });

    const paginatedData = computed(() => {
      const start = (currentPage.value - 1) * rowsPerPage.value;
      const end = start + rowsPerPage.value;
      return filteredData.value.slice(start, end);
    });

    const nextPage = () => {
      if (currentPage.value < totalPages.value) currentPage.value++;
    };

    const prevPage = () => {
      if (currentPage.value > 1) currentPage.value--;
    };

    const changeRowsPerPage = () => {
      currentPage.value = 1; // Reset to the first page on rows per page change
    };

    return {
      data,
      searchQuery,
      rowsPerPage,
      rowsOptions,
      currentPage,
      totalPages,
      paginatedData,
      nextPage,
      prevPage,
      changeRowsPerPage,
    };
  },
};
</script>

<style scoped>


.search-input {
  padding: 8px;
  margin-bottom: 16px;
  width: 100%;
  box-sizing: border-box;
}

.rows-select {
  margin-bottom: 16px;
  padding: 8px;
  width: 100%;
  box-sizing: border-box;
}

.data-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 16px;
}

.data-table th,
.data-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.pagination button {
  padding: 8px 12px;
  cursor: pointer;
}

.pagination button[disabled] {
  cursor: not-allowed;
  opacity: 0.5;
}
</style>
