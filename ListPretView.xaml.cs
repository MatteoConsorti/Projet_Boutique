using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
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
using WpfGestImmo.Data.DAL;
using WpfGestImmo.Views.Utils;

namespace WpfGestImmo.Views.SubViews
{
    public partial class ListPretView : IObserver
    {
        private ObservableCollection<Pret> pretList;
        public ListPretView()
        {
            InitializeComponent();
            pretList = new ObservableCollection<Pret>();
            lstPrets.ItemsSource = pretList;
            lstPrets.SelectionChanged += LstPrets_SelectionChanged;
            this.refreshList();
        }

        private void refreshList()
        {
            GestImmoContext ctx = GestImmoContext.getInstance();
            pretList.Clear();

            foreach(Pret prets in ctx.Prets)
            {
               pretList.Add(prets);
            }
        }
        public void update()
        {
            this.refreshList();
        }


        private void LstPrets_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (lstPrets.SelectedItem != null)
            {
                Pret selectedPret = (Pret)lstPrets.SelectedItem;
                NavigationService?.Navigate(new DetailPret(selectedPret));
                lstPrets.SelectedItem = null;
            }
        }
    }
}
