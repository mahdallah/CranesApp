using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace HijazCranes.Models
{
    public abstract class EntityBase
    {
        [DataType(DataType.Date)]
        [DisplayFormat(DataFormatString = "{0:ddd, dd MMM yyyy hh:mm tt}", ApplyFormatInEditMode = true)]
        public DateTime Created { get; set; } = DateTime.Now;
    }
}