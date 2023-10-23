using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace HijazCranes.Models
{
    public class QuoteCranes
    {
        public int Id { get; set; }
        public int Crane_Id { get; set; }
        public int Quote_Id { get; set; }
        public double Price { get; set; }

        //public DateTime Start { get; set; }
        //public DateTime End { get; set; }


        [DisplayName("Hired Hours")]
        public int? HiredHours { get; set; }


        [DisplayName("Hired Items")]
        public int? HiredItems { get; set; }


        [ForeignKey("Crane_Id")]
        public Crane Crane { get; set; }


        [ForeignKey("Quote_Id")]
        public Quote Quote { get; set; }
    }
}