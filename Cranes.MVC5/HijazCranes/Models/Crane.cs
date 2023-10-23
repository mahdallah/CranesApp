using System;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Web;

namespace HijazCranes.Models
{
    public class Crane 
    {
        public int Id { get; set; }

        public string Name { get; set; }


        [DisplayName("Maximum Wieght Can Lift (Ton)")]
        [Range(4, 30)]
        public double MaxWeightLiftInTon { get; set; }


        [DisplayName("Price Per Hour")]
        public double PricePerHour { get; set; }


        [DisplayName("Price Per Item")]
        public double PricePerItem { get; set; }


        public string Plate { get; set; }

        public string Image { get; set; }


        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;


        [NotMapped]
        [DisplayName("Image File")]
        public HttpPostedFileBase ImageFile { get; set; }
    }
}