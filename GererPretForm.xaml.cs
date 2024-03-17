using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Xml.Linq;
using WpfGestImmo.Data.DAL;
using WpfGestImmo.Views.Utils;

namespace WpfGestImmo.Views.Forms
{
    public partial class GererPretForm : Page, IObservable
    {
        private IEnumerable biens;
        private List<IObserver> observers = new List<IObserver>();
        private double tauxInteret;
        private double montantPret;
        private DateTime dateDebut;

        public GererPretForm()
        {
            InitializeComponent();
            biens = this.loadBiens();
            cmbPret.ItemsSource = biens;
            cmbPret.DisplayMemberPath = "Name";
        }

        private List<Bien> loadBiens()
        {
            GestImmoContext ctx = GestImmoContext.getInstance();
            return ctx.Biens.ToList();
        }

        public List<IObserver> Observers
        {
            get => observers;
            set => observers = value;
        }

        // Ajouter Pret
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            try
            {

                double mensualite = double.Parse(this.txtMensualite.Text);
                double duree = double.Parse(this.txtDuree.Text);
                double apport = double.Parse(this.txtApport.Text);
                Bien bien = (Bien)this.cmbPret.SelectedItem;

                Pret pret = new Pret(tauxInteret, montantPret, duree, mensualite, apport, dateDebut);
                GestImmoContext ctx = GestImmoContext.getInstance();

                ctx.Prets.Add(pret);
                ctx.SaveChanges();

                this.notifyObservers();
                MessageBox.Show("Le prêt a été ajouté avec succès.", "Succès");
            }
            catch (FormatException ex)
            {
                MessageBox.Show("Format d'entrée invalide. Veuillez saisir des valeurs numériques valides.", "Erreur");
            }
        }

        void notifyObservers()
        {
            foreach (IObserver obs in Observers)
            {
                obs.update();
            }
        }

        
    }
}