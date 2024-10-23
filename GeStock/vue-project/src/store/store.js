import { createStore } from 'vuex';
import router from '../router/index';
import axios from 'axios';

const store = createStore({
  state: {
    Sidbar: 'Users',
    body: 'Product',
    errorMessage: '',
    user: null,
    clients: [],
    fournisseurs: [],
    categories: [],
    products: [],
    factures: [],
    commandes: [],
    users: []
  },
  mutations: {
    setSidbar(state, value) {
      state.Sidbar = value
    },
    setbody(state, value) {
      state.body = value
    },
    setError(state, value) {
      state.errorMessage = value
    },
    setUser(state, user) {
      state.user = user
    },
    setClients(state, clients) {
        state.clients = clients;
      },
      setFournisseurs(state, fournisseurs) {
        state.fournisseurs = fournisseurs;
      },
      setCategories(state, categories) {
        state.categories = categories;
      },
      setProducts(state, products) {
        state.products = products;
      },
      setFactures(state, factures) {
        state.factures = factures;
      },
      setCommandes(state, commandes) {
        state.commandes = commandes;
      },
      setUsers(state, users) {
        state.users = users;
      }  
  },
  actions: {
    //sign up
    async signUp(context, user) {
      user.password_confirmation = user.password
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', user);
        sessionStorage.setItem('name', response.data.user.name);
        sessionStorage.setItem('email', response.data.user.email);
        sessionStorage.setItem('token', response.data.token);
        router.push('/dashboard');
      } catch (error) {
        let errorMessage = 'حدث خطأ أثناء إنشاء الحساب. الرجاء المحاولة مرة أخرى.';
        if (error.response && error.response.data && error.response.data.message) {
          errorMessage = error.response.data.message;
        } else if (error.response && error.response.data && typeof error.response.data === 'object') {
          errorMessage = Object.values(error.response.data).join(', ');
        }
        context.commit('setError', errorMessage);
      }
    },
    // login
    async login(context, credentials) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', credentials);
        
        // Store user data in sessionStorage
        sessionStorage.setItem('name', response.data.user.name);
        sessionStorage.setItem('email', response.data.user.email);
        sessionStorage.setItem('token', response.data.token);
        
        // Update state
        context.commit('setUser', response.data.user);
        context.commit('setError', '');
        
        // Redirect to dashboard
        router.push('/dashboard');
      } catch (error) {
        let errorMessage = 'فشل تسجيل الدخول. الرجاء التحقق من بيانات الاعتماد الخاصة بك.';
        if (error.response && error.response.data && error.response.data.message) {
          errorMessage = error.response.data.message;
        } else if (error.response && error.response.data && typeof error.response.data === 'object') {
          errorMessage = Object.values(error.response.data).join(', ');
        }
        context.commit('setError', errorMessage);
      }
    },
    // log out
    async logOut(context) {
      try {
        const response = await axios.post(
          'http://127.0.0.1:8000/api/logout',
          {},
          {
            headers: {
              'Authorization': `Bearer ${sessionStorage.getItem('token')}`
            }
          }
        );
        if (response) {
          sessionStorage.clear();
          context.commit('setUser', null);
          router.push('/');
        }
      } catch (error) {
        context.commit('setError', 'حدث خطأ أثناء تسجيل الخروج');
      }
    },
    async fetchClients({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/clients', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setClients', response.data);
        } catch (error) {
          commit('setError', 'Error fetching clients');
        }
      },

      async createClient({ commit }, clientData) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/client', clientData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          commit('setClients', [...this.state.clients, response.data]);
        } catch (error) {
          commit('setError', 'Error creating client');
          throw error;
        }
      },
      
      async updateClient({ commit }, clientData) {
        try {
          const response = await axios.post(`http://127.0.0.1:8000/api/client/update/${clientData.id}`, clientData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
      
          const updatedClients = this.state.clients.map(client =>
            client.id === response.data.id ? response.data : client
          );
          
          commit('setClients', updatedClients);
        } catch (error) {
          commit('setError', 'Error updating client');
          throw error;
        }
      },
      async deleteClient({ commit }, clientId) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/client/${clientId}`, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
      
          // Optionally update local state or fetch clients again after deleting.
          
          const updatedClients = this.state.clients.filter(client => client.id !== clientId);
          
          commit('setClients', updatedClients);
          
        } catch (error) {
          commit('setError', 'Error deleting client');
        }
      },
      async fetchFournisseurs({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/fournissurs', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setFournisseurs', response.data);
        } catch (error) {
          commit('setError', 'Error fetching fournisseurs');
        }
      },
    
      async fetchFournisseur({ commit }, id) {
        try {
          const response = await axios.get(`http://127.0.0.1:8000/api/fournissur/${id}`, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          return response.data; // Return the fetched fournisseur data
        } catch (error) {
          commit('setError', 'Error fetching fournisseur');
        }
      },
    
      async createFournisseur({ commit }, fournisseurData) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/fournissur', fournisseurData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          commit('setFournisseurs', [...this.state.fournisseurs, response.data]); // Add the new fournisseur to the existing list
        } catch (error) {
          commit('setError', 'Error creating fournisseur');
        }
      },
    
      async updateFournisseur({ commit, state }, fournisseurData) {
        try {
          const response = await axios.post(`http://127.0.0.1:8000/api/fournissur/update/${fournisseurData.id}`, fournisseurData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
      
          // Update the local state with the updated fournisseur
          const updatedFournisseurs = state.fournisseurs.map(f => 
            f.id === fournisseurData.id ? response.data : f
          );
          
          commit('setFournisseurs', updatedFournisseurs);
        } catch (error) {
          commit('setError', 'Error updating fournisseur');
        }
      },
    
      async deleteFournisseur({ commit }, id) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/fournissur/${id}`, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
    
          // Remove the deleted fournisseur from the state
          const filteredFournisseurs = this.state.fournisseurs.filter(f => f.id !== id);
          
          commit('setFournisseurs', filteredFournisseurs);
        } catch (error) {
          commit('setError', 'Error deleting fournisseur');
        }
      },

      
  
      async fetchCategories({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/categories', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setCategories', response.data);
        } catch (error) {
          commit('setError', 'Error fetching categories');
        }
      },

      async createCategory({ commit }, categoryData) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/categori', categoryData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          commit('setCategories', [...this.state.categories, response.data]); // Add the new category to the existing list
        } catch (error) {
          commit('setError', 'Error creating category');
        }
      },
   
  
      async fetchProducts({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/products', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setProducts', response.data);
        } catch (error) {
          commit('setError', 'Error fetching products');
        }
      },
  
      async createProduct({ commit }, productData) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/product', productData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          commit('setProducts', [...this.state.products, response.data]); // Add the new product to the existing list
        } catch (error) {
          commit('setError', 'Error creating product');
        }
      },
   
      async fetchFactures({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/factures', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setFactures', response.data);
        } catch (error) {
          console.error('Error fetching factures:', error);
          commit('setError', 'Error fetching factures');
          throw error;
        }
      },
  
      async createFacture({ commit, state }, factureData) {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/facture', factureData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          const updatedFactures = [...state.factures, response.data];
          commit('setFactures', updatedFactures);
          return response.data;
        } catch (error) {
          console.error('Error creating facture:', error);
          commit('setError', error.response?.data?.message || 'Error creating facture');
          throw error;
        }
      },
  
      async updateFacture({ commit, state }, factureData) {
        try {
          const response = await axios.post(`http://127.0.0.1:8000/api/facture/update/${factureData.id}`, factureData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          const updatedFactures = state.factures.map(facture => 
            facture.id === factureData.id ? response.data : facture
          );
          
          commit('setFactures', updatedFactures);
          return response.data;
        } catch (error) {
          console.error('Error updating facture:', error);
          commit('setError', error.response?.data?.message || 'Error updating facture');
          throw error;
        }
      },
  
      async deleteFacture({ commit, state }, id) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/facture/${id}`, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          
          const updatedFactures = state.factures.filter(facture => facture.id !== id);
          commit('setFactures', updatedFactures);
        } catch (error) {
          console.error('Error deleting facture:', error);
          commit('setError', error.response?.data?.message || 'Error deleting facture');
          throw error;
        }
      },

      async fetchCommandes({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/Commendes', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setCommandes', response.data);
        } catch (error) {
          commit('setError', 'Error fetching commandes');
        }
      },
  
      async createCommande({commit}, commandeData){
        try{
            const response=await axios.post("http://127.0.0.1:8000/api/Commende",commandeData,{
                headers:{'Authorization':`Bearer ${sessionStorage.getItem("token")}`}
            });
            commit("setCommandes",[...this.state.commandes,response.data]);
        }catch(error){
            commit("setError","Erreur lors de la création de la commande");
        }
   
      },

      async fetchUsers({ commit }) {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/users', {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem('token')}` }
          });
          commit('setUsers', response.data);
        } catch (error) {
          commit('setError', 'Error fetching users');
        }
      },
      async createUser({ commit }, userData) {
        try {
          const response = await axios.post("http://127.0.0.1:8000/api/user", userData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem("token")}` }
          });
          commit("addUser", response.data);
        } catch (error) {
          commit("setError", "Erreur lors de la création de l'utilisateur");
        }
      },
      async updateUser({ commit, state }, { userData }) {
        try {
          const response = await axios.put(`http://127.0.0.1:8000/api/user/${userData.id}`, userData, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem("token")}` }
          });
          const updatedUsers = state.users.map(user => 
            user.id === userData.id ? response.data : user
          );
          commit("setUsers", updatedUsers);
        } catch (error) {
          commit("setError", "Erreur lors de la mise à jour de l'utilisateur");
          throw error;
        }
      },
      async deleteUser({ commit }, id) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/user/${id}`, {
            headers: { 'Authorization': `Bearer ${sessionStorage.getItem("token")}` }
          });
          commit("removeUser", id);
        } catch (error) {
          commit("setError", "Erreur lors de la suppression de l'utilisateur");
        }
      }
      
  },
  getters: {
    getSidebar(state) {
      return state.Sidbar
    },
    getbody(state) {
      return state.body
    },
    isLoggedIn(state) {
      return !!state.user || !!sessionStorage.getItem('token')
    },
    getClients: (state) => state.clients,
    getFournisseurs: (state) => state.fournisseurs,
    getCategories: (state) => state.categories,
    getProducts: (state) => state.products,
    getFactures: (state) => state.factures,
    getCommandes: (state) => state.commandes,
    getUsers: (state) => state.users

  }
})

export default store;