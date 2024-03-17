using System;
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
using WpfGestImmo.Views.Forms;
using WpfGestImmo.Views.SubViews;

namespace WpfGestImmo.Views
{
    /// <summary>
    /// Logique d'interaction pour PretView.xaml
    /// </summary>
    public partial class PretView : Page
    {
        private ListPretView listPretView;
        private GererPretForm gererPretForm;

        public PretView()
        {
            InitializeComponent();

            listPretView = new ListPretView();
            gererPretForm = new GererPretForm();

            pretFrameGauche.Navigate(listPretView);
            pretFrameDroite.Navigate(gererPretForm);
        }

        private void ShowListPretView(object sender, RoutedEventArgs e)
        {
            pretFrameGauche.Navigate(listPretView);
        }

        private void ShowGererPretForm(object sender, RoutedEventArgs e)
        {
            pretFrameDroite.Navigate(gererPretForm);
        }

        private void Frame_Navigated(object sender, NavigationEventArgs e)
        {

        }
    }
}
